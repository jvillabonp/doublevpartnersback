<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">Links</div>
                <div class="card-body">
                    <pre id="pre"></pre>
                </div>
            </div>
        </div>
    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var data = {
                "Obtener Usuarios": {
                    "Método": "GET",
                    "URL": "{{ url('/api/users') }}",
                    "Parámetros": {
                        "q": {
                            "Requerido": false,
                            "Tipo": "String"
                        },
                        "perPage": {
                            "Requerido": false,
                            "Tipo": "Int|Number"
                        },
                        "page": {
                            "Requerido": false,
                            "Tipo": "Int|Number",
                            "Add": "Anexar para ver la siguiente página"
                        }
                    }
                },
                "Guardar Usuario": {
                    "Método": "POST",
                    "URL": "{{ url('/api/users') }}",
                    "Parámetros": {
                        "name": {
                            "Requerido": true,
                            "Tipo": "String"
                        },
                        "email": {
                            "Requerido": true,
                            "Tipo": "String|Email"
                        }
                    }
                },
                "Obtener Usuario": {
                    "Método": "GET",
                    "URL": "{{ url('/api/users/{email}') }}",
                    "Parámetros": {}
                },

                "Obtener Tickets": {
                    "Método": "GET",
                    "URL": "{{ url('/api/ticket') }}",
                    "Parámetros": {
                        "q": {
                            "Requerido": false,
                            "Tipo": "String"
                        },
                        "perPage": {
                            "Requerido": false,
                            "Tipo": "Int|Number"
                        },
                        "page": {
                            "Requerido": false,
                            "Tipo": "Int|Number",
                            "Add": "Anexar para ver la siguiente página"
                        }
                    }
                },
                "Guardar Ticket": {
                    "Método": "POST",
                    "URL": "{{ url('/api/ticket') }}",
                    "Parámetros": {
                        "description": {
                            "Requerido": true,
                            "Tipo": "String"
                        },
                        "email": {
                            "Requerido": true,
                            "Tipo": "String|Email"
                        },
                        "status": {
                            "Requerido": false,
                            "Tipo": "String|In:[abierto,cerrado]"
                        }
                    }
                },
                "Obtener Ticket": {
                    "Método": "GET",
                    "URL": "{{ url('/api/ticket/{ticket}') }}",
                    "Parámetros": {}
                },
                "Actualizar Ticket": {
                    "Método": "PUT",
                    "URL": "{{ url('/api/ticket/{ticket}') }}",
                    "Parámetros": {
                        "description": {
                            "Requerido": false,
                            "Tipo": "String"
                        },
                        "email": {
                            "Requerido": false,
                            "Tipo": "String|Email"
                        },
                        "status": {
                            "Requerido": true,
                            "Tipo": "String|In:[abierto,cerrado]"
                        }
                    }
                },
                "Eliminar Ticket": {
                    "Método": "DELETE",
                    "URL": "{{ url('/api/ticket/{ticket}') }}",
                    "Parámetros": {}
                },
                "Restaurar Ticket": {
                    "Método": "PUT",
                    "URL": "{{ url('/api/ticket/restore/{ticket}') }}",
                    "Parámetros": {}
                }
            };

            document.getElementById("pre").textContent = JSON.stringify(data, undefined, 2);
        });
    </script>
</html>
