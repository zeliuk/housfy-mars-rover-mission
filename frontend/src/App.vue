<template>
  <div class="min-h-screen bg-slate-50">
    <!-- Header -->
    <header class="border-b bg-white">
      <div
        class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 flex items-center justify-between"
      >
        <div>
          <h1 class="text-lg font-semibold text-slate-900">
            Mars Rover Mission
          </h1>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
        <!-- Planet -->
        <section class="lg:col-span-8">
          <div
            class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 overflow-hidden"
          >
            <div class="p-5">
              <div
                class="aspect-square w-full rounded-xl border border-slate-300 bg-slate-50 flex items-center justify-center"
              ></div>
            </div>
          </div>
        </section>

        <!-- Form -->
        <section class="lg:col-span-4">
          <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="border-b px-5 py-4">
              <h2 class="text-sm font-semibold text-slate-900">
                Control del Rover
              </h2>
            </div>

            <div class="p-5">
              <div
                class="rounded-xl border border-slate-300 bg-slate-50 px-4 py-6"
              ></div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>
