@extends('layouts.base')

@section('content')
    <div class="row">

        <div class="col-6 offset-md-3 ">
            <x-elements.section :title="'Crear Gremio'">
                <x-slot name="content">
                    <form action="{{route('guild.store')}}" method="POST">
                        @csrf
                        <x-elements.form-group :label="'Nombre del Gremio'">
                            <x-slot name="content">
                                <x-elements.form-input.input
                                    name="name"
                                    :value="old('name')"
                                    placeholder="Ej: Los Guerreros del Norte"
                                    required
                                    :errors="$errors"
                                />
                            </x-slot>
                        </x-elements.form-group>
                        <x-elements.form-group :label="'Tag'">
                            <x-slot name="content">
                                <x-elements.form-input.input
                                    name="slug"
                                    :value="old('slug')"
                                    placeholder="LGDN"
                                    prepend="["
                                    append="]"
                                    required
                                    :errors="$errors"
                                />
                            </x-slot>
                        </x-elements.form-group>
                        <x-elements.form-group :label="'Descripcion'">
                            <x-slot name="content">
                                <x-elements.form-input.input
                                    name="description"
                                    :value="old('description')"
                                />
                            </x-slot>
                        </x-elements.form-group>
                        @php
                            $config = ['inputColClass' => 'col-sm-9 text-center']
                        @endphp
                        <x-elements.form-group :label="'Es publico'" :config="$config" >
                            <x-slot name="content">
                                <x-elements.form-input.switchery
                                    name="is_public"
                                    :checked="old('is_public')"
                                />
                            </x-slot>
                        </x-elements.form-group>
                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-default width-100 mb-xs mr-3" role="button">
                                <i class="fa fa-check text-default"></i>
                                Crear
                            </button>
                            <button class="btn btn-danger width-110 mb-xs mr-3" role="button">
                                <i class="fa fa-xmark text-default"></i>
                                Cancelar
                            </button>
                        </div>
                    </form>
                </x-slot>
            </x-elements.section>
        </div>

    </div>
    <script>
        function togglePassword() {
            const input = document.querySelector('input[name="password"]');
            const icon = document.querySelector('#toggleBtn i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        function searchPlayer() {
            const searchTerm = document.querySelector('input[name="search_player"]').value;
            if (searchTerm) {
                // Aquí puedes hacer una petición AJAX o redirigir
                console.log('Buscando:', searchTerm);
            }
        }
    </script>
@endsection
