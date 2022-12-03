 <!-- Post-item -->
 <div class="post-item post-item--green">
    <div class="post-item__inner">
        <div class="row">
            <div class="col-md-7">
                <div class="embed-responsive embed-responsive-16by9 sm-mb15">
                    <div id="elle-player"></div>
                </div>
                @foreach($data as $value)
                <script>
                    function youtube_parser(url){
                        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                        var match = url.match(regExp);
                        return (match&&match[7].length==11)? match[7] : false;
                    }
                    var source = '{{$value['data']->video_news}}';
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/player_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                    var player;
                    function onYouTubeIframeAPIReady() {
                        player = new YT.Player('elle-player', {
                            videoId: youtube_parser(source),
                            width: '100%',
                            height: '100%', 
                            playerVars: {
                                autoplay: 1,        // Auto-play the video on load
                                controls: 1,        // Show pause/play buttons in player
                                showinfo: 0,        // Hide the video title
                                modestbranding: 1,  // Hide the Youtube Logo
                                //loop: 1,            // Run the video in a loop
                                //fs: 0,              // Hide the full screen button
                                //cc_load_policy: 0, // Hide closed captions
                                //iv_load_policy: 3,  // Hide the Video Annotations
                                autohide: 0         // Hide video controls when playing
                            },
                            events: {
                            onReady: function(e) {
                                e.target.mute();
                            }
                            }
                        });
                    }
                </script>
            </div>


            <div class="col-md-5">
                <div class="post-item__info sm-mb15" data="">

                <span class="post-item__title" style="cursor: default;">{{$value['data']->name}}</span>
                    <div class="post-item__desc">
                        {!!$value['data']->content_news!!}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
        <div class="banner-content hidden-md hidden-lg">

</div>