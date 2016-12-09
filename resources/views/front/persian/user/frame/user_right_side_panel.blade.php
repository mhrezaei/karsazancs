<div class="col-sm-3">
    <section class="panel user-info">
        <article>
            <div class="avatar"><img src="{{ url('/assets/images/avatar.png') }}" width="96"></div>
            <h1 class="user-name"> {{ $user->name_first . ' ' . $user->name_last}} </h1>
            <div class="balance">
                <div class="right"> <span> {{ trans('front.balance') }} </span>
                    <h1> @pd($user->site_credit) {{ trans('front.toman') }} </h1> </div>
                <a href="#" class="action button green icon-plus"></a>
            </div>
            <?php
            $order_count = count($user->orders());
            ?>
            <h2 class="order-count"> @pd($order_count) <small>{{ trans('front.order') }}</small> </h2> </article>
    </section>
</div>