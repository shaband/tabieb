@extends('website.layouts.app')

@section('title')

    {!! __("Search") !!}
@endsection



@section('content')
    <!-- START Page Title -->
    <section id="page-tit" class="tit-wz-search"
             style="background: url({{asset('design/images/bg-main.png')}}) no-repeat 50% 50%;background-size: cover;">
        <div class="container">
            <div class="page-tit-inner">
                <h1>{{ __('Find your doctor')}}</h1>
                @include('website.partials._search_form')
            </div>
        </div>
    </section>
    <!-- END Page Title -->


    <!-- START Main Content -->
    <section class="main-content">
        <div id="search-pg" class="bg-greyColor6 py-5">
            <div class="container">
                <!-- START Doctors Container -->
                <div class="docs-container">

                    @foreach($doctors as $doctor)


                        @include('website.partials._search_doctor_block')

                    @endforeach
                </div>
                <!-- END Doctors Container -->
                {{--         <!-- START Doctors Pages -->
                         <div class="paging">
                             <nav class="pt-5" aria-label="Page navigation example">
                                 <ul class="pagination justify-content-center">
                                     <li class="page-item active">
                                         <a class="page-link" href="#" aria-label="Previous">
                                             <span aria-hidden="true">&laquo;</span>
                                             <span class="sr-only">Previous</span>
                                         </a>
                                     </li>
                                     <li class="page-item"><a class="page-link" href="#">1</a></li>
                                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                                     <li class="page-item">
                                         <a class="page-link" href="#" aria-label="Next">
                                             <span aria-hidden="true">&raquo;</span>
                                             <span class="sr-only">Next</span>
                                         </a>
                                     </li>
                                 </ul>
                             </nav>
                         </div>
                         <!-- END Doctors Pages -->
                --}}
                {{$doctors->links()}}
            </div>
        </div>
    </section>
    <!-- END Main Content -->
@endsection
