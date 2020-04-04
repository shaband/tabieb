<div class="intro-search" data-delay="2000" data-aos="fade-up">
    <form class="form-secondary" action="{!! route('reservation.search') !!}">
        <div class="row align-items-end justify-content-center">
            <div class="col-sm-6 col-md-3 col-lg">
                <div class="form-group">
                    <label for="">{!! __("search by name") !!}</label>
                    <input type="text" class="form-control" name="doctor_name"
                           placeholder="search by name">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg">
                <div class="form-group">
                    <label for="">{!!  __("select specialities") !!}</label>
                    <select class="form-control bootstrap-select" name="category_id">
                        <option value="">{!! __("Select Category")!!}</option>

                        @foreach($categories as $key=>$category)
                            <option value="{!! $key !!}">{!! $category->name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg">
                <div class="form-group">
                    <label for="">{{ __('available time from')}}</label>
                    <input type="time" name="from_time" class="form-control " placeholder="pick time">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg">
                <div class="form-group">
                    <label for="">{{ __('available time to')}}</label>
                    <input type="time" name="to_time" class="form-control " placeholder="pick time">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg">
                <div class="search-confirm">
                    <button type="submit"
                            class="btn bg-primary-gradient-x text-white w-100">{{ __('Search now')}}
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
