<template>
  <section id="calendar" class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary mb-2">Church Calendar</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Stay updated with all our upcoming events and activities
        </p>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-7 gap-4 mb-8">
        <div class="bg-primary text-white p-4 text-center font-semibold">Sun</div>
        <div class="bg-primary text-white p-4 text-center font-semibold">Mon</div>
        <div class="bg-primary text-white p-4 text-center font-semibold">Tue</div>
        <div class="bg-primary text-white p-4 text-center font-semibold">Wed</div>
        <div class="bg-primary text-white p-4 text-center font-semibold">Thu</div>
        <div class="bg-primary text-white p-4 text-center font-semibold">Fri</div>
        <div class="bg-primary text-white p-4 text-center font-semibold">Sat</div>

        <!-- Calendar Days -->
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">30</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">1</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">2</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">3</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">4</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">5</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">6</span>
          <div class="mt-2 bg-secondary text-primary text-xs p-1 rounded">
            Sabbath Service
          </div>
        </div>

        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">7</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">8</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">9</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">10</span>
          <div class="mt-2 bg-red text-white text-xs p-1 rounded">Prayer Meeting</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">11</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">12</span>
          <div class="mt-2 bg-blue text-white text-xs p-1 rounded">Youth Night</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">13</span>
          <div class="mt-2 bg-secondary text-primary text-xs p-1 rounded">
            Sabbath Service
          </div>
        </div>

        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">14</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">15</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">16</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">17</span>
          <div class="mt-2 bg-red text-white text-xs p-1 rounded">Prayer Meeting</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">18</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">19</span>
          <div class="mt-2 bg-blue text-white text-xs p-1 rounded">Youth Night</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">20</span>
          <div class="mt-2 bg-secondary text-primary text-xs p-1 rounded">
            Sabbath Service
          </div>
          <div class="mt-1 bg-green text-white text-xs p-1 rounded">
            Community Service
          </div>
        </div>

        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">21</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">22</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">23</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">24</span>
          <div class="mt-2 bg-red text-white text-xs p-1 rounded">Prayer Meeting</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">25</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">26</span>
          <div class="mt-2 bg-blue text-white text-xs p-1 rounded">Youth Night</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">27</span>
          <div class="mt-2 bg-secondary text-primary text-xs p-1 rounded">
            Sabbath Service
          </div>
        </div>

        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">28</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">29</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">30</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg relative">
          <span class="text-gray-600">31</span>
          <div class="mt-2 bg-red text-white text-xs p-1 rounded">Prayer Meeting</div>
        </div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">1</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">2</div>
        <div class="bg-gray-50 p-3 min-h-[120px] rounded-lg">3</div>
      </div>

      <div class="bg-gray-50 p-6 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Recurring Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-secondary rounded-full"></div>
            <span>Sabbath Service (Every Saturday)</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-red rounded-full"></div>
            <span>Prayer Meeting (Every Wednesday)</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-blue rounded-full"></div>
            <span>Youth Night (Every Friday)</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-green rounded-full"></div>
            <span>Community Service (Monthly)</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts"></script>

<style scoped></style>
