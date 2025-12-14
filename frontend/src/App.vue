<script setup>
import { reactive, ref } from "vue";

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
                      placeholder="0 - 199"
                      class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                    />
                  </div>

                  <div>
                    <label class="block text-xs font-medium text-slate-700"
                      >Y</label
                    >
                    <input
                      v-model.number="rover.y"
                      type="number"
                      placeholder="0 - 199"
                      class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                    />
                  </div>
                </div>

                <!-- Direction -->
                <div>
                  <label class="block text-xs font-medium text-slate-700"
                    >Orientació</label
                  >
                  <select
                    v-model="rover.direction"
                    class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                  >
                    <option value="">Escull orientació</option>
                    <option value="N">Nord (N)</option>
                    <option value="E">Est (E)</option>
                    <option value="S">Sud (S)</option>
                    <option value="W">Oest (W)</option>
                  </select>
                </div>

                <!-- Commands -->
                <div>
                  <label class="block text-xs font-medium text-slate-700"
                    >Ordres</label
                  >
                  <input
                    v-model="rover.commands"
                    type="text"
                    placeholder="FFRFFL"
                    class="mt-1 w-full rounded-lg border px-3 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 border-slate-300"
                  />
                  <p class="mt-1 text-xs text-slate-500">
                    Ordres permeses: F, L, R
                  </p>
                </div>

                <!-- Actions -->
                <div class="flex gap-2 pt-2">
                  <button
                    type="button"
                    class="cursor-pointer w-full rounded-lg bg-housfy px-4 py-3 text-md font-bold text-white transition"
                  >
                    Executar
                  </button>

                  <button
                    type="button"
                    class="cursor-pointer rounded-lg bg-white px-4 py-3 text-md font-bold text-black ring-1 ring-slate-200"
                  >
                    Resetejar
                  </button>
                </div>
              </form>
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
