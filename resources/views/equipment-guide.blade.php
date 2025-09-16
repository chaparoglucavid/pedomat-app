@extends('layouts.app')

@section('content')
    <div class="phone pb-bottom-nav">
        <div class="page__header">
            <h1 class="page__title">Cihazdan istifadə qaydası</h1>
            <p class="page__sub">Addım-addım təlimat</p>
        </div>


        <div class="auth-card" style="max-width:760px; margin:0 auto;">
            <article class="prose" style="color:var(--ink)">
                <h2 class="auth-title" style="font-size:18px">Başlanğıc</h2>
                <p>Əvvəlcə mobil tətbiqi yükləyin. Cihazın yanında olmağınız vacib deyil — tətbiqdən ödəniş edərək ped ala bilərsiniz.</p>


                <h2 class="auth-title" style="font-size:18px">İstifadə qaydası</h2>
                <ol style="margin-left:18px">
                    <li>Tətbiqdən ped bileti alın. Alınan biletlərin istifadə müddəti <strong>4 saatdır</strong>.</li>
                    <li>4 saat ərzində ped aldığınız cihazın yanına yaxınlaşın.</li>
                    <li>Tətbiqdən <strong>Profil → Sifarişlərim</strong> bölməsinə keçin.</li>
                    <li>“Barkodu istifadə et” düyməsinə basın.</li>
                    <li>Tətbiq sizə barkod göstərəcək. Bu barkodu cihazın oxuyucusuna tutun.</li>
                    <li>Cihaz sizə sifarişdəki sayda ped verəcək.</li>
                </ol>


                <h2 class="auth-title" style="font-size:18px">Texniki dəstək</h2>
                <p>Hər hansı texniki problem yaranarsa, tətbiqin <strong>Profil → Texniki dəstək</strong> bölməsi ilə əlaqə saxlayın.</p>
            </article>


            <div class="action-bar">
                <a href="{{ url()->previous() }}" class="btn btn--outline">Geri</a>
            </div>
        </div>
    </div>
@endsection
