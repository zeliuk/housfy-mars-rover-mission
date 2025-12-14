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
              <!-- (vacío por ahora) -->
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
