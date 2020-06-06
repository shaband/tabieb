@extends('website.layouts.app')

@section('title')

    {!! __("Prescription")  !!}

@endsection
@section('content')

    @include('website.partials._title_section')

    <!-- START Main Content -->
    <section class="main-content">
        <div id="profile-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                    <div class="heading-blk text-center mb-3 aos-init aos-animate" data-aos="fade-down">
                        <h5 class="heading-tit-wz-after font-weight-bold">{{__("Add")}} <span
                                class="text-secondary">{{__("Prescription")}}</span><br><img src="{{ heading_line()}}">
                        </h5>
                    </div>
                    <div class="pres-form-container text-center">

                        {!! Form::model($prescription,['method'=>'post' ,'class'=>'basic-form form-md form-label-inline m-auto']) !!}

                        {!! Form::hidden('reservation_id',$prescription->reservation_id) !!}
                        <div class="form-group">
                            <label for="">{{__('Disease')}}:</label>
                            {!! Form::text('diagnosis',null,['class'=>'form-control','placeholder'=>__("Enter disease")]) !!}
                        </div>
                        <div class="form-group">

                            <label for="">{{ __('notes')}}:</label>
                            {!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>__("Enter disease")]) !!}

                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ __("Medicine")}}</th>
                                <th>{{ __("Dose")}}</th>
                                <th>{{ __("Notes")}}</th>
                                <th>{{ __("Delete")}}</th>
                            </tr>
                            </thead>

                            <tbody id="medicine-table-body">
                            @forelse(old('items')??$prescription->items  ??[] as $item)
                                <tr>
                                    <td>
                                        <input name="items[{!! $loop->index !!}][medicine]" class="form-control"
                                               value="{!! $item['medicine'] ??null!!}"
                                               placeholder="{{ __("Medicine")}}">
                                    </td>
                                    <td>
                                        <input name="items[{!! $loop->index !!}][dose]" class="form-control"
                                               value="{!! $item['dose'] ??null!!}" placeholder=" {{ __("dose") }}">
                                    </td>
                                    <td>
                                        <input name="items[{!! $loop->index !!}][description]" class="form-control"
                                               value="{!! $item['description'] ??null!!}"
                                               placeholder=" {{ __("Note") }}"
                                        >
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removeItem(this)"><i
                                                class="fas fa-times"></i></button>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <input name="items[0][medicine]" class="form-control"
                                               value=""
                                               placeholder="{{ __("Medicine")}}">
                                    </td>
                                    <td>
                                        <input name="items[0][dose]" class="form-control"
                                               value="" placeholder=" {{ __("dose") }}">
                                    </td>
                                    <td>
                                        <input name="items[0][description]" class="form-control" value=""
                                               placeholder=" {{ __("Note") }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removeItem(this)"><i
                                                class="fas fa-times"></i></button>
                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>
                        <div>
                            <a class="btn btn-secondaryLight w-100 text-capitalize" onclick="addMedicineRow()">
                                {{ __('add another medicine')}}
                            </a>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-thirdly text-capitalize">
                                {{ __('save changes')}}
                            </button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <!-- END Contact Block -->
        </div>
    </section>
    <!-- END Main Content -->

@endsection

@push('scripts')
    <script>

        function medicine_row(index) {
            var slot = 'items[' + index + ']';
            var row = ' <tr>\n' +
                '                                        <td>\n' +
                '                                            <input name="' + slot + '[medicine]" class="form-control"\n' +
                '                                                   value=""\n' +
                '                                                   placeholder="{{ __("Medicine")}}">\n' +
                '                                        </td>\n' +
                '                                        <td>\n' +
                '                                            <input name="' + slot + '[dose]" class="form-control"\n' +
                '                                                   value="" placeholder=" {{ __("dose") }}">\n' +
                '                                        </td>\n' +
                '                                        <td>\n' +
                '                                            <input name="' + slot + '[description]" class="form-control" value=""\n' +
                '                                                   placeholder=" {{ __("Note") }}">\n' +
                '                                        </td>\n' +
                '\n' +
                ' <td>' +
                ' <button type="button" class="btn btn-danger" onclick="removeItem(this)"><i class="fas fa-times"></i></button>' +
                '</td>' +
                '                                    </tr>';
            return row;
        }

        function addMedicineRow() {
            var exists_medicine = $('#medicine-table-body'),
                index = exists_medicine.children().length,
                new_row = medicine_row(index);
            exists_medicine.append(new_row);

        }

        function removeItem(btn) {

            var row = $(btn).closest('tr').remove()
        }
    </script>
@endpush



