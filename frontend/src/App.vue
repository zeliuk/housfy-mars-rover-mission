<script setup>
import { reactive, computed, ref } from "vue";

const loading = ref(false);
const result = ref(null);
const apiError = ref(null);

const planetConfig = {
  width: 200,
  height: 200,
  obstacles: [[2, 2]],
};

const rover = reactive({
  x: "",
  y: "",
  direction: "",
  commands: "",
});

const touched = reactive({
  x: false,
  y: false,
  direction: false,
  commands: false,
});

const errors = computed(() => {
  const e = {};

  if (rover.x === "" || rover.x < 0 || rover.x > 199) {
    e.x = "La X ha d'estar entre 0 i 199";
  }

  if (rover.y === "" || rover.y < 0 || rover.y > 199) {
    e.y = "La Y ha d'estar entre 0 i 199";
  }

  if (!["N", "E", "S", "W"].includes(rover.direction)) {
    e.direction = "Escull una orientació vàlida";
  }

  if (!rover.commands || !/^[FLR]+$/i.test(rover.commands)) {
    e.commands = "Només es permeten les ordres F, L i R";
  }

  return e;
});

const isValid = computed(() => Object.keys(errors.value).length === 0);

const resetForm = () => {
  rover.x = "";
  rover.y = "";
  rover.direction = "";
  rover.commands = "";

  Object.keys(touched).forEach((key) => {
    touched[key] = false;
  });

  result.value = null;
  apiError.value = null;
};
</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <!-- Header -->
    <header class="shadow-md border-none bg-white">
      <div
        class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 flex items-center justify-between"
      >
        <div class="flex items-center gap-3">
          <img
            src="@/assets/logo.svg"
            alt="Mars Rover Mission"
            style="height: 32px; width: auto"
          />

          <h1 class="text-lg font-semibold text-slate-900 invisible">
            Mars Rover Mission Housfy
          </h1>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
        <!-- Form -->
        <section class="lg:col-span-8">
          <div class="rounded-md bg-white shadow-2sm ring-1 ring-slate-200">
            <div
              class="rounded-t-md border-b border-slate-200 px-5 py-4 bg-housfysoft"
            >
              <h2 class="text-md font-bold text-slate-900">
                Control del Rover
              </h2>
            </div>

            <div class="p-5">
              <div class="">
                <form class="space-y-4">
                  <!-- Coordinates -->
                  <div class="grid grid-cols-2 gap-3">
                    <div>
                      <label class="block text-xs font-medium text-slate-700"
                        >X</label
                      >
                      <input
                        v-model.number="rover.x"
                        type="number"
                        @blur="touched.x = true"
                        placeholder="0 - 199"
                        class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                      />
                      <p
                        v-if="touched.x && errors.x"
                        class="text-xs text-red-600 mt-1"
                      >
                        {{ errors.x }}
                      </p>
                    </div>

                    <div>
                      <label class="block text-xs font-medium text-slate-700"
                        >Y</label
                      >
                      <input
                        v-model.number="rover.y"
                        type="number"
                        @blur="touched.y = true"
                        placeholder="0 - 199"
                        class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                      />
                      <p
                        v-if="touched.y && errors.y"
                        class="text-xs text-red-600 mt-1"
                      >
                        {{ errors.y }}
                      </p>
                    </div>
                  </div>

                  <!-- Direction -->
                  <div>
                    <label class="block text-xs font-medium text-slate-700">
                      Orientació
                    </label>
                    <select
                      v-model="rover.direction"
                      @blur="touched.direction = true"
                      class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                    >
                      <option value="">Escull orientació</option>
                      <option value="N">Nord (N)</option>
                      <option value="E">Est (E)</option>
                      <option value="S">Sud (S)</option>
                      <option value="W">Oest (W)</option>
                    </select>
                    <p
                      v-if="touched.direction && errors.direction"
                      class="text-xs text-red-600 mt-1"
                    >
                      {{ errors.direction }}
                    </p>
                  </div>

                  <!-- Commands -->
                  <div>
                    <label class="block text-xs font-medium text-slate-700">
                      Ordres
                    </label>
                    <input
                      :value="rover.commands"
                      @input="
                        rover.commands = $event.target.value.toUpperCase()
                      "
                      type="text"
                      @blur="touched.commands = true"
                      placeholder="FFRFFL"
                      class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                    />
                    <p class="mt-1 text-xs text-slate-500">
                      Ordres permeses: F, L, R
                    </p>
                    <p
                      v-if="touched.commands && errors.commands"
                      class="text-xs text-red-600 mt-1"
                    >
                      {{ errors.commands }}
                    </p>
                  </div>

                  <!-- Actions -->
                  <div class="flex gap-2 pt-2">
                    <button
                      type="button"
                      :disabled="!isValid || loading"
                      @click="executeRover"
                      class="cursor-pointer w-full rounded-lg bg-housfy px-4 py-3 text-md font-bold text-white transition disabled:bg-slate-200 disabled:text-white disabled:opacity-60 disabled:cursor-auto"
                    >
                      <span v-if="!loading">Executar</span>
                      <span v-else>S'està executant...</span>
                    </button>

                    <button
                      type="button"
                      class="cursor-pointer rounded-lg bg-white px-4 py-3 text-md font-bold text-black ring-1 ring-slate-200"
                      @click="resetForm"
                    >
                      Resetejar
                    </button>
                  </div>
                </form>
              </div>

              <div
                v-if="apiError"
                class="mt-4 rounded-lg bg-red-50 p-3 text-sm text-red-700"
              >
                {{ apiError }}
              </div>
            </div>
          </div>
        </section>

        <!-- Result -->
        <section class="lg:col-span-4">
          <div
            class="rounded-md bg-white shadow-sm ring-1 ring-slate-200 overflow-hidden"
          >
            <div
              class="rounded-t-md border-b border-slate-200 px-5 py-4 bg-housfysoft"
            >
              <h2 class="text-md font-bold text-slate-900">
                Resultat de la missió
              </h2>
            </div>

            <div class="p-5">
              <!-- (vacío por ahora) -->
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>
