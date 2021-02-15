<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        
          // 'App\Model' => 'App\Policies\ModelPolicy',
        
        'App\Project' => 'App\Policies\ProjectPolicy', // belirli bir model türüne karşı eylemlere yetki verirken hangi politikanın kullanılacağını belirler.
                                                       // Bir politikanın kaydedilmesi, Laravel'e belirli bir Eloquent modeline karşı eylemleri yetkilendirirken hangi politikayı kullanacağını söyleyecektir.
                                                       // Project::class => ProjectPolicy::class şeklinde de olur.

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();


        // Kapanıştan önce boş olmayan bir sonuç(true,false) döndürürse, bu sonuç yetkilendirme kontrolünün sonucu olarak kabul edilecektir.
        // Diğer tüm yetkilendirme kontrollerinden önce çalıştırılan bir kapanışı tanımlamak için before yöntemini kullanabilirsiniz.
        // Diğer tüm yetkilendirme kontrollerinden sonra yürütülecek bir kapatmayı tanımlamak için after yöntemini kullanabilirsiniz.
        $gate->before(function($user){ // Policyden önce ilk trigger budur,
            return $user->id == 2; // this is an admin id 2.
        });
    }
}
