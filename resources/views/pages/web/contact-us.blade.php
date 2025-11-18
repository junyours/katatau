@extends('layouts.web')

@section('content')
  <div class="space-y-4">
    <h1 class="font-bold text-base border-b border-slate-300 pb-4">Contact Us</h1>
    <div class="space-y-4">
      <h1 class="font-semibold text-center">Metro Square R118 Zone 2, Iponan, CDO City</h1>
      <div class="flex items-center justify-around gap-4 max-sm:flex-col">
        <div class="flex items-center gap-2">
          <i data-lucide="mail" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="mailto:ditads@infosheet.dev" target="_blank"
            class="font-semibold hover:text-[#AD0404]">ditads@infosheet.dev</a>
        </div>
        <div class="flex items-center gap-2">
          <i data-lucide="phone" class="size-5 text-[#AD0404]" stroke-width="1.5"></i>
          <a href="tel:+639171281320" target="_blank" class="font-semibold hover:text-[#AD0404]">+63 917 128 1320</a>
        </div>
      </div>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1973.018828961073!2d124.59800653282302!3d8.495719504874366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff3bb5ad3a1dd%3A0xd7dd14c89de28c9b!2sMetro%20Square!5e0!3m2!1sen!2sph!4v1761352907659!5m2!1sen!2sph"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
@endsection