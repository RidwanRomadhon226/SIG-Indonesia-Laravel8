                        @if (Session::has('flash_message_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Selesai !</strong>  {!! session('flash_message_success') !!}
                        </div>
                        @endif
                        @if (Session::has('flash_message_error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Terdapat Masalah !</strong>  {!! session('flash_message_error') !!}
                        </div>
                        @endif

                        @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Terdapat Masalah !</strong>  {{ $error }}
                        </div>
                         @endforeach
                        @endif
