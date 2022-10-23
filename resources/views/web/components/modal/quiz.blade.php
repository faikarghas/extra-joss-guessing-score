{{-- MODAL QUIZ --}}
<div class="modal-quiz z-50 hidden flex-wrap bg-black w-[400px] md:w-[750px] py-14 px-20 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">

  <div class="close">
      <div class="">
          <img src="{{asset('/images/close.png')}}" />
      </div>
  </div>
  <div class="act-wrapper">
        <div class="basis-act">
        @auth
            <button data-id="{{Auth::user()->id}}" class="btn-quiz act-quiz bg-[#FF0000]">Pertanyaan Selanjutnya</button>
        @endauth
        </div>
        <div class="point-qz basis-act">
            <img src="{{asset('images/acv.png')}}" />
            <h5>400 POIN</h5>
        </div>
  </div>
</div>