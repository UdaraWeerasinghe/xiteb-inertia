<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $authUserType = auth()->user()->type ?? NULL;

            $usePermissions = [
                [
                    'type' => 1,
                    'name' => 'pharmacy',
                    'USER_ADD' => true,
                    'USER_VIEW' => true,
                    'PRODUCT_VIEW' => true,
                    'PRESCRIPTION_VIEW' => true,
                    'PRESCRIPTION_VIEW_DETAILS' => true,
                    'QUETATION_ADD' => true,
                    'QUETATION_ACCEPT' => true,
                    'QUETATION_REJECT' => true,
                    'QUETATION_SEND' => true,
                    'QUETATION_VIEW' => true,
                ],
                [
                    'type' => 2,
                    'name' => 'user',
                    'PRESCRIPTION_ADD' => true,
                    'PRESCRIPTION_VIEW' => true,
                    'PRESCRIPTION_VIEW_DETAILS' => true,
                    'QUETATION_VIEW' => true,
                ]
            ];

            $userMenus = [
                [
                    'type' => 1,
                    'name' => 'pharmacy',
                    'menu' => [
                        [
                            'name' => 'Users',
                            'route' => 'users.index'
                        ],
                        [
                            'name' => 'products',
                            'route' => 'products.index'
                        ],                [
                            'name' => 'Prescription',
                            'route' => 'prescriptions.index'
                        ],
                        [
                            'name' => 'Quetaions',
                            'route' => 'quetations.index'
                        ]
                    ]
                        
                ],
                [
                    'type' => 2,
                    'name' => 'user',
                    'menu' => [   
                         [
                            'name' => 'Prescription',
                            'route' => 'prescriptions.index'
                         ],
                         [
                            'name' => 'Quetaions',
                            'route' => 'quetations.index'
                        ]
                    ]
                ]
               
            ];
            if($authUserType != NULL){

                $permissions = collect($usePermissions)->where('type',$authUserType)->first();
                $menu = collect($userMenus)->where('type',$authUserType)->first()['menu'];
            }

        return array_merge(parent::share($request), [
            
            'user' => [
                'name' => auth()->user()
                     ? auth()->user()->first_name.' '.auth()->user()->last_name
                     : NULL,
                'permissions' => $permissions ?? NULL,
                'menu' => $menu ?? NULL
            ],

            'flash' => [
                'message' => session('message')
            ],

        ]);
    }
}
