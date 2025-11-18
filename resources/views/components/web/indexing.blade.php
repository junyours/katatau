@php
  $images = [
    ['src' => asset('images/indexing/1.png')],
    ['src' => asset('images/indexing/2.png')],
    ['src' => asset('images/indexing/3.png')],
    ['src' => asset('images/indexing/5.png')],
    ['src' => asset('images/indexing/6.png')],
    ['src' => asset('images/indexing/7.png')],
    ['src' => asset('images/indexing/8.png')],
    ['src' => asset('images/indexing/9.png')],
    ['src' => asset('images/indexing/10.png')],
    ['src' => asset('images/indexing/11.png')],
    ['src' => asset('images/indexing/12.png')],
    ['src' => asset('images/indexing/13.png')],
    ['src' => asset('images/indexing/14.png')],
    ['src' => asset('images/indexing/16.png')],
    ['src' => asset('images/indexing/17.png')],
  ]
@endphp

<div>
  <h1 class="bg-[#AD0404] text-white px-4 py-2 font-bold rounded-md">Indexing and Abstracting</h1>
  <div x-data="{            
    // Sets the time between each slides in milliseconds
    autoplayIntervalTime: 3000,
    slides: @js($images),         
    currentSlideIndex: 1,
    isPaused: false,
    autoplayInterval: null,
    previous() {                
        if (this.currentSlideIndex > 1) {                    
            this.currentSlideIndex = this.currentSlideIndex - 1                
        } else {   
            // If it's the first slide, go to the last slide           
            this.currentSlideIndex = this.slides.length                
        }            
    },            
    next() {                
        if (this.currentSlideIndex < this.slides.length) {                    
            this.currentSlideIndex = this.currentSlideIndex + 1                
        } else {                 
            // If it's the last slide, go to the first slide    
            this.currentSlideIndex = 1                
        }            
    },    
    autoplay() {
        this.autoplayInterval = setInterval(() => {
            if (! this.isPaused) {
                this.next()
            }
        }, this.autoplayIntervalTime)
    },
    // Updates interval time   
    setAutoplayInterval(newIntervalTime) {
        clearInterval(this.autoplayInterval)
        this.autoplayIntervalTime = newIntervalTime
        this.autoplay()
    },    
}" x-init="autoplay" class="relative h-50 w-full overflow-hidden border-b border-slate-300">
    <template x-for="(slide, index) in slides">
      <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
        x-transition.opacity.duration.1000ms>
        <img class="absolute size-full inset-0 object-contain" x-bind:src="slide.src" />
      </div>
    </template>
  </div>
</div>