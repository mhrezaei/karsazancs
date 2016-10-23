<?php

namespace App\Providers;

use App\models\Branch;
use App\Models\Department;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


class TahaServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function register()
    {
    }

    public static function topbarNotificationMenu()
    {
        $branches = Branch::all() ;
        $array = [] ;
        $sep = false ;
        $total = 0 ;

        //Posts...
        foreach($branches as $branch) {
            if(Auth::user()->can('posts-'.$branch->slug.".publish")) {
                $count = Post::counter($branch->slug, 'auto' , 'pending') ;
                $total += $count ;
                if($count) {
                    $count = AppServiceProvider::pd($count) ;
                    array_push($array , [
                         "manage/posts/$branch->slug/pending" ,
                         $branch->title(0)." ".trans('posts.manage.pending')." ( $count ) ",
                         $branch->icon ,
                    ]) ;
                }
            }
        }

        //Cards...
        if(Auth::user()->can('cards.print')) {
            $count = User::counter('card' , 'print_request') ;
            $total += $count ;
            if($count) {
                $count = AppServiceProvider::pd($count) ;
                array_push($array , [
                     "manage/cards/browse/print_request" ,
                     trans('people.cards.short_title_y')." ".trans('people.cards.manage.print_request')." ( $count ) ",
                     'credit-card' ,
                ]) ;
            }

            $count = User::counter('card' , 'print_control') ;
            $total += $count ;
            if($count) {
                $count = AppServiceProvider::pd($count) ;
                array_push($array , [
                     "manage/cards/browse/print_control" ,
                     trans('people.cards.manage.print_control')." ( $count ) ",
                     'credit-card' ,
                ]) ;
            }
        }


        //Volunteers...
        if(Auth::user()->can('volunteers.publish')) {
            $count = User::counter('volunteer' , 'pending') ;
            $total += $count ;
            if($count) {
                $count = AppServiceProvider::pd($count) ;
                array_push($array , [
                     "manage/volunteers/browse/pending" ,
                     trans('people.volunteers.short_title')." ".trans('people.volunteers.manage.pending')." ( $count ) ",
                     'child' ,
                ]) ;
            }
        }
        if(Auth::user()->can('volunteers.edit')) {
            $count = User::counter('volunteer' , 'care') ;
            $total += $count ;
            if($count) {
                $count = AppServiceProvider::pd($count) ;
                array_push($array , [
                     "manage/volunteers/browse/care" ,
                     trans('people.volunteers.short_title')." ".trans('people.volunteers.manage.care')." ( $count ) ",
                     'child' ,
                ]) ;
            }
        }

        $array['total'] = $total ;
        return $array ;
    }

    public static function topbarCreateMenu()
    {
        $branches = Branch::all() ;
        $array = [] ;
        $sep = false ;

        foreach($branches as $branch) {
            if(Auth::user()->can('posts-'.$branch->slug.".create"))
                array_push($array , [
                     "manage/posts/$branch->slug/create" ,
                     trans('manage.global.create_in' , ['thing'=>$branch->title(0)]),
                     $branch->icon ,
                ]) ;
        }

        //Other things...
        if(Auth::user()->can('cards.create') or Auth::user()->can('volunteers.create'))
            array_push($array ,['-'] );

        if(Auth::user()->can('cards.create')) {
            array_push($array, [
                 "manage/cards/create",
                 trans('people.cards.manage.create'),
                 'credit-card',
            ]);
        }
        if(Auth::user()->can('volunteers.create')) {
            array_push($array , [
                 "manage/volunteers/create" ,
                 trans('people.volunteers.manage.create') ,
                 'child' ,
            ]);
        }

        return $array ;

    }

    public static function sidebarTicketsMenu()
    {
        $departments = Department::orderBy('title')->get() ;
        $array = [] ;
        $sub_menus = [] ;

        foreach($departments as $department) {
            if(Auth::user()->can("tickets-$department->slug")) {
                array_push($sub_menus , [
                     'tickets/'.$department->slug ,
                     $department->title ,
                     $department->icon ,
                ]);
            }
        }

        $array = [
             'icon' => 'ticket' ,
             'caption' => trans('manage.modules.tickets') ,
             'link' => 'tickets' ,
             'sub_menus' => $sub_menus ,
             'permission' =>  sizeof($sub_menus)? 'any' : 'dev',
        ];

        return $array ;

    }

    public static function sidebarPostsMenu()
    {
        $groups = Branch::groups()->get() ;
        $array = [] ;

        foreach($groups as $group) {
            $branches = Branch::where('header_title' , $group->header_title)->orderBy('plural_title')->get() ;
            $sub_menus = [] ;
            foreach($branches as $branch) {
                if(Auth::user()->can("posts-$branch->slug")) {
                    array_push($sub_menus , [
                         'posts/'.$branch->slug ,
                         $branch->plural_title ,
                         $branch->icon ,
                    ]);
                }
            }

            array_push($array , [
                 'icon' => 'dot-circle-o' ,
                 'caption' => $group->header_title ? $group->header_title : trans('posts.manage.global') ,
                 'link' => 'asd' ,
                 'sub_menus' => $sub_menus ,
                 'permission' =>  sizeof($sub_menus)? '' : 'dev',
            ]);

        }

        return $array ;
    }

	/**
      * A shortcut for Auth::user()->can() which is located in PermitsTrait, used in User model.
      * @param $permit
      * @return mixed
      */
    public static function can($permit)
    {
        return Auth::user()->can($permit) ;
    }

}
