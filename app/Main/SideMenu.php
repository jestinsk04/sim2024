<?php

namespace App\Main;
use Illuminate\Support\Facades\Auth;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {   
        if(isset(Auth::user()->role_id)){

   
        if(Auth::user()->role_id == 0){

            return [
                'dashboard' => [
                    'icon' => '',
                    'title' => 'Paises',
                    'sub_menu' => [
                        'listado-paises' => [
                            'icon' => '',
                            'route_name' => 'paises-display',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Listado Paises'
                        ]
                    ]
                ],
                'usuarios' => [
                    'icon' => '',
                    'title' => 'Usuarios',
                    'sub_menu' => [
                        'listado-usuarios' => [
                            'icon' => '',
                            'route_name' => 'usuarios-display',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Listado Usuarios'
                        ]
                    ]
                ],
                'data' => [
                    'icon' => '',
                    'title' => 'Data',
                    'sub_menu' => [
                        'listado-data' => [
                            'icon' => '',
                            'route_name' => 'data-add',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Importar Data'
                        ]
                    ]
                ],
                'proveedores' => [
                    'icon' => '',
                    'title' => 'Proveedores',
                    'sub_menu' => [
                        'listado-proveedores' => [
                            'icon' => '',
                            'route_name' => 'proveedores-display',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Listado Proveedores'
                        ]
                    ]
                ],
            ];



        }else{

            $paises = explode(",", Auth::user()->paises);
            $secciones = explode(",", Auth::user()->secciones);
            $subsecciones = explode(",", Auth::user()->subsecciones);
            $dashboard = explode(",", Auth::user()->dashboard);

         

            return [
                'dashboard' => [
                    'icon' => '',
                    'title' => 'KPI´s País',
                    'sub_menu' => [
                        'dashboard-usuario' => [
                            'icon' => '',
                            'route_name' => 'dashboard-usuario',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Dashboard'
                        ],
                        'dashboard-demografico' => [
                            'icon' => '',
                            'route_name' => 'dashboard-demografico',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Demográfico'
                        ]
                    ]
                ],
                'menu-layout' => [
                    'icon' => '',
                    'title' => 'Reportes',
                    'sub_menu' => [
                        'reportes-analisis' => [
                            'icon' => '',
                            'route_name' => 'dashboard-usuario',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Reportes de Análisis'
                        ],
                        'reportes-investigacion' => [
                            'icon' => '',
                            'route_name' => 'dashboard-usuario',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Reportes de Investigación'
                        ],
                        'tendencias' => [
                            'icon' => '',
                            'route_name' => 'dashboard-usuario',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Tendencias'
                        ]
                    ]
                        ],
                'ventas-layout' => [
                    'icon' => '',
                    'title' => 'Ventas',
                    'sub_menu' => [
                        'mercado-local' => [
                            'icon' => '',
                            'route_name' => 'dashboard-usuario',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Mercado Local'
                        ]
                    ]
                        ],
            ];

        }

    }else{
        return [
            'dashboard' => [
                'icon' => '',
                'title' => 'KPI´s País',
                'sub_menu' => [
                    'dashboard-usuario' => [
                        'icon' => '',
                        'route_name' => 'dashboard-usuario',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Dashboard'
                    ],
                    'dashboard-overview-2' => [
                        'icon' => '',
                        'route_name' => 'dashboard-usuario',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Demográfico'
                    ]
                ]
            ],
            'menu-layout' => [
                'icon' => '',
                'title' => 'Reportes',
                'sub_menu' => [
                    'reportes-analisis' => [
                        'icon' => '',
                        'route_name' => 'dashboard-usuario',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Reportes de Análisis'
                    ],
                    'reportes-investigacion' => [
                        'icon' => '',
                        'route_name' => 'dashboard-usuario',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Reportes de Investigación'
                    ],
                    'tendencias' => [
                        'icon' => '',
                        'route_name' => 'dashboard-usuario',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Tendencias'
                    ]
                ]
                    ],
                    'ventas-layout' => [
                        'icon' => '',
                        'title' => 'Ventas'
                    ]
        ];
    }


    }
}
