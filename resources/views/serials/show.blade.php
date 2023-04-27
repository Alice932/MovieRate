@extends('layouts.app')

@section('content')
        <div class="col1">
            <div class="blog">
        <!-- Column 1 -->
                <h2 class="heading">{{ $serial->title }}</h2>
                <ul class="bloglisting">
                    <li>
                        <div class="thumb">
                            <img src = 'https://de.web.img3.acsta.net/c_310_420/medias/nmedia/18/83/52/87/19695765.jpg' alt="" width="154" height="222"/>
                        </div>
                        <div class="desc">
                            <h3 class="colr">{{ $serial->title }}</h3>
                            <p>Director: {{ $serial->director }}</p>
                            <p>Actors: {{ $serial->actors }}</p>
                            <p>Year: {{ $serial->year }}</p>
                            <p>Genre: {{ $serial->genre }}</p>
                            <p>During: {{ $serial->time }}</p>
                            <div class="clear"></div>
                            <p class="txt">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed elit. Nulla sem risus,
                                vestibulu volutpat eget, dapibus ac, lectus. Curabitur dolor sapien, hendrerit non Lorem
                                ipsum dolor sit amet, consectetuer adipiscing elit. Sed elit. Nulla sem risus...
                            </p>
                        </div>
                        <br />
                        <p class="txt">
                            {{ $serial->content }}
                        </p>
                        <br />
                        <p class="txt">
                            cNam sapien. Maecenas mattis blandit lacus. Cras non pede. Phasellus consectetuer.
                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas. Suspendisse ut augue. Mauris non magna. Nunc in enim. In hendrerit lorem sit amet
                            mi. Aliquam rutrum, turpis id tempor ullamcorper, sem risus molestie tortor, eget placerat
                            ante tortor at tortor. Mauris odio.
                        </p>
                        <br />
                        <p class="txt">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed elit. Nulla sem risus,
                            vestibulum in, volutpat eget, dapibus ac, lectus. Curabitur dolor sapien, hendrerit non,
                            suscipit bibendum, auctor ac, arcu. Vestibulum dapibus. Sed pede lacus, pretium in,
                            condimentum sit amet, mollis dapibus, magna. Ut bibendum dolor nec augue. Ut tempus luctus
                            metus. Sed a velit. Pellentesque at libero elementum ante condimentum sollicitudin.
                            Pellentesque lorem ipsum, semper quis, interdum et, sollicitudin eu, purus. Vivamus
                            fringilla ipsum vel orci. Phasellus vitae massa at massa pulvinar pellentesque. Fusce
                            tincidunt libero vitae odio. Donec malesuada diam nec mi. Integer hendrerit pulvinar ante.
                            Donec eleifend, nisl eget aliquam congue, justo metus venenatis neque, vel tincidunt elit
                            augue sit amet velit. Nulla facilisi. Aenean suscipit.
                        </p>
                        <br />
                        <p class="txt">
                            cNam sapien. Maecenas mattis blandit lacus. Cras non pede. Phasellus consectetuer.
                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas. Suspendisse ut augue. Mauris non magna. Nunc in enim. In hendrerit lorem sit amet
                            mi. Aliquam rutrum, turpis id tempor ullamcorper, sem risus molestie tortor, eget placerat
                            ante tortor at tortor. Mauris odio.
                        </p>

                        <br />
                        <p class="txt">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed elit. Nulla sem risus,
                            vestibulum in, volutpat eget, dapibus ac, lectus. Curabitur dolor sapien, hendrerit non,
                            suscipit bibendum, auctor ac, arcu. Vestibulum dapibus. Sed pede lacus, pretium in,
                            condimentum sit amet, mollis dapibus, magna. Ut bibendum dolor nec augue. Ut tempus luctus
                            metus. Sed a velit. Pellentesque at libero elementum ante condimentum sollicitudin.
                            Pellentesque lorem ipsum, semper quis, interdum et, sollicitudin eu, purus. Vivamus
                            fringilla ipsum vel orci. Phasellus vitae massa at massa pulvinar pellentesque. Fusce
                            tincidunt libero vitae odio. Donec malesuada diam nec mi. Integer hendrerit pulvinar ante.
                            Donec eleifend, nisl eget aliquam congue, justo metus venenatis neque, vel tincidunt elit
                            augue sit amet velit. Nulla facilisi. Aenean suscipit.
                        </p>
                        <br />
                        <p class="txt">
                            cNam sapien. Maecenas mattis blandit lacus. Cras non pede. Phasellus consectetuer.
                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas. Suspendisse ut augue. Mauris non magna. Nunc in enim. In hendrerit lorem sit amet
                            mi. Aliquam rutrum, turpis id tempor ullamcorper, sem risus molestie tortor, eget placerat
                            ante tortor at tortor. Mauris odio.
                        </p>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
