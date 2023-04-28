@extends('layouts.app')

@section('content')
        <div class="col1">
            <div class="blog">
        <!-- Column 1 -->
                <h2 class="heading">{{ $movie->title }}</h2>
                <ul class="bloglisting">
                    <li>
                        <div class="thumb">
                            <img src = {{ $movie->image }} alt="" width="154" height="222"/>
                        </div>
                        <div class="desc">
                            <h3 class="colr">{{ $movie->title }}</h3>
                            <p>Director: {{ $movie->director }}</p>
                            <p>Actors: {{ $movie->actors }}</p>
                            <p>Year: {{ $movie->year }}</p>
                            <p>Genre: {{ $movie->genre }}</p>
                            <p>During: {{ $movie->time }}</p>
                            <div class="clear"></div>
                        </div>
                        <br />
                        <p class="txt">
                            {{ $movie->content }}
                        </p>
                        <br />
                        {{-- <p class="txt">
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
                        </p> --}}
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
