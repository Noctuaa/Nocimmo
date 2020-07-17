@extends('layouts.app')

@section('content')
    <div class="row mobile_filter">
        <search-filter></search-filter>
    </div>
    <div class="slider" style="height: 100vh">
        <slider></slider>
        <scrollto></scrollto>
    </div>

    <div class="container">
        <section id="courchevel">
        <!--<section_home section='courchevel' :images="/*json_encode(["#pic1Courchevel", "#pic2Courchevel"])*/}}">-->
            <div class="row">
                <div class="col-12">
                    <h2>Courchevel</h2>
                </div>
            </div>
            <div class="row flex-lg-row flex-column-reverse first_p">
                <div class="col-lg-6 col-12 d-inline-flex align-items-center">
                    <p>
                        Courchevel est une station de sports d’hiver de la vallée de la Tarentaise située sur la commune de
                        Courchevel (jusqu’en 2016, la commune de Saint-Bon-Tarentaise),
                        dans le département de la Savoie en région Auvergne-Rhône-Alpes. Première station française aménagée
                        en site vierge en 1946, elle fait partie du domaine skiable des Trois-Vallées.
                        La station est organisée autour de cinq villages : Saint-Bon-Tarentaise (chef-lieu communal),
                        Courchevel Le Praz (appelé avant 2011 Courchevel 1300),
                        Courchevel Village (anciennement Courchevel 1500), Courchevel Moriond (anciennement Courchevel 1650)
                        et enfin Courchevel (anciennement Courchevel 1850).
                        Ce dernier, qui donne son nom à la station, est le premier noyau de développement où s’applique le
                        travail de l’architecte urbaniste Laurent Chappis et de l’ingénieur Maurice Michaud.
                    </p>
                </div>
                <div class="col-lg-6 col-12 p-0 d-flex justify-content-center p-md-3">
                    <img class="img-fluid" id="pic1Courchevel" src="{{asset('/images/courchevel_info.jpg')}}" alt="Photo de Courchevel">
                </div>
            </div>
            <div class="row second_p">
                <div class="col-lg-6 col-12 p-0 d-flex justify-content-center p-md-3">
                    <img class="img-fluid" id="pic2Courchevel" src="{{asset('/images/courchevel_info.jpg')}}" alt="Photo de Courchevel">
                </div>
                <div class="col-lg-6 col-12 d-inline-flex align-items-center">
                    <p>
                        Cette nouvelle urbanisation de la montagne a fait l’objet d’une inscription à l’inventaire
                        supplémentaire des monuments historiques en 1998, et une trentaine de sites sont protégés au titre
                        des monuments historiques.
                        La station ne se limite pas à la seule saison hivernale et ses pratiques du ski, elle s’est équipée
                        notamment d’infrastructures collectives de loisirs et sportives, comme un centre aqualudique ouvert
                        en décembre 2015,
                        et propose d’autres pratiques en lien avec la montagne durant l’été, avec la randonnée ou le VTT,
                        mais aussi son festival international d’art pyrotechnique ou encore l’organisation d’exposition
                        d’art contemporain.
                        Courchevel bénéficie généralement d’une image « haut de gamme » tant dans les médias nationaux et
                        internationaux que dans la littérature plus spécialisée, au même titre que d’autres stations
                        savoyardes.
                        <br>
                        <span>Source : Wikipédia </span>
                    </p>
                </div>
            </div>
        </section>
        <!--</section_home>-->
        <hr>
        <section id="presentation">
            <div class="row">
                <div class="col-12 mb-3">
                    <h1>Chalets et Caviar</h1>
                </div>
            </div>
            <div class="row who">
                <div class="col-lg-6 col-12 d-inline-flex align-items-center">
                    <p>
                        Séjournez ou vivez votre rêve dans nos chalets de prestige, que ce soit pour les vacances ou trouver
                        votre nid, Chalets et caviar vous accompagnent dans un esprit de confort et de sécurité.
                        Nous vous proposons nos ventes et locations de chalets d’exceptions et de charme aux prestations
                        d’excellence, digne des Grands Hotels de luxe.
                        Notre objectifs est de pouvoir rendre vos rêves réalisables.
                        Pour vous accompagnez dans votre choix ou pour tous renseignements et informations, vous pouvez nous
                        contacter via le formulaire de contact.
                        <br>
                        Nous répondrons très rapidement à votre demande.
                        <br>Chalets et Caviar
                    </p>
                </div>
                <div class="col-lg-6 col-12 d-flex justify-content-center">
                    <img class="img-fluid" src="{{asset('/images/Man.png')}}" alt="Photo décorative businessman">
                </div>
            </div>
        </section>
    </div>
    
@endsection

@section('script')
    <script>
        /**
         * Animation of the page according to the scroll
         * @param {string} scrollTrigger 
         */
        function animation(scrollTrigger){
            const myTimeline = gsap.timeline({ 
                paused: true,
                scrollTrigger: scrollTrigger,
            });

            if(scrollTrigger === '#courchevel p'){
                const images = document.querySelectorAll('#courchevel img')
                myTimeline
                .from(images[0], {autoAlpha: 0, x: 200, duration: 1.5, ease: 'Power0.easeNone'})
                .from(images[1], {autoAlpha: 0, x: -200, duration: 1.5, delay: -1.5, ease: 'Power0.easeNone'})
                .from("#courchevel p ," +  "#courchevel h2", {autoAlpha: 0, duration: 0.7, ease: 'power2.out'})
            }else{
                myTimeline
                .from('#presentation img', {opacity: 0, x: 300, duration: 1, ease: 'Power0.easeNone'})
                .from("#presentation p , #presentation h2", {opacity: 0, duration: 1, ease: 'power2.out'})
            }
        }

        window.addEventListener('load', () => {
            if (window.matchMedia("(min-width: 960px)").matches) {
                this.animation("#courchevel p");
                this.animation('#presentation p');
            }
        }) 
        
    </script>
@endsection


