@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Admin Localization') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Strings') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create new') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2" data-toggle="tab"
                                href="#home-{{ $language->lang }}" role="tab" aria-controls="home"
                                aria-selected="true">{{ $language->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach ($languages as $language)
                        <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                            id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">

                            <div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <form method="POST" action="{{ route('admin.extract-localize-string') }}">
                                                @csrf
                                                <input type="hidden" name="directory"
                                                    value="{{ resource_path('views/frontend') }},{{ app_path('Http/Controllers/Frontend') }},{{ resource_path('views/mail') }},{{ resource_path('views/auth') }}">
                                                <input type="hidden" name="language_code" value="{{ $language->lang }}">
                                                <input type="hidden" name="file_name" value="frontend">

                                                <button type="submit"
                                                    class="btn btn-primary mx-3">{{ __('Generate Strings') }}</button>
                                            </form>

                                            <form class="translate-from" method="POST"
                                                action="">
                                                <input type="hidden" name="language_code" value="{{ $language->lang }}">
                                                <input type="hidden" name="file_name" value="admin">
                                                <button type="submit"
                                                    class="btn btn-dark mx-3 translate-button">{{ __('Translate Strings') }}</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-{{ $language->lang }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th class="text-center">
                                                    {{ __('String') }}
                                                </th>
                                                <th class="text-center">
                                                    {{ __('Translation') }}
                                                </th>
                                                <th class="text-center">
                                                    {{ __('Action') }}
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


        </div>
    </section>

    <!-- Button trigger modal -->
@endsection

@push('scripts')
    <script>
        @foreach ($languages as $language)
            $("#table-{{ $language->lang }}").dataTable({
                "columnDefs": [{
                    "sortable": false,

                }]
            });
        @endforeach
    </script>
@endpush