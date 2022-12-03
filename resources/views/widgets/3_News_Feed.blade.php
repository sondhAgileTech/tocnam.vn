


                <div class="row">
                    <div class="col-md-9">
                                                    <!-- Post-item -->
                        @foreach($data as $value)
                                <div class="post-item post-item--purple  post-item--border-bottom">
                                    <div class="post-item__inner">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__thumb img_16_9">
                                                    <img src="{{asset('storage/'.$value->img_news)}}" alt="" class="lazy img-responsive" style="">
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="post-item__info sm-mt15">
                                                    <div class="post-item__detail">
                                                        <span class="post-item__circle"></span>
                                                        <a class="post-item__detail-sub post-item__category" href="/{{$value->slugs}}">{{$value->name_cate}}</a>
                                                        <span class="post-item__detail-sub post-item__time time_moment" onclick="time_moment($(this),{{date('YmdHi',strtotime($value->time_news_updated))}})" data-time="{{$value->time_news_updated}}"> {{now()->diffForHumans($value->time_news_updated)}}</span>
                                                        <div class="post-item__detail-sub post-item__share">
                                                            <div class="post-item__share-text">Chia sẻ</div>
                                                            <div class="post-item__share-inner">
                                                                  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{asset('')}}{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__share-icon post-item__share-facebook" title="facebook"><i class="fab fa-facebook"></i></a>
																<a target="_blank" href="https://www.pinterest.com/pin/create/button/?url={{asset('')}}{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__share-icon post-item__share-twitter" title="printerest"><i class="fab fa-pinterest"></i></a>
																<a target="_blank" href="https://plus.google.com/share?url={{asset('')}}{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__share-icon post-item__share-twitter" title="g+"><i class="fab fa-google-plus-g"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                            <a href="/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__title">{{$value->name_news}}</a>
                                                    <div class="post-item__desc">
                                                            {{$value->description_news}}
                                                    </div>
                                                 <div class="post-item-author mt15 mb_mt10">
                                                      {{$value->name_user}}
                                                 </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                <!-- /Post-item -->

                                            </div>
                                            <div class="col-md-3" id="ellevietnam">
                                                    <div class="instagram-sidebar hidden-xs hidden-sm">
                                                        <div class="instagram-sidebar__inner">
                                                            <div class="instagram-sidebar__title">
                                                                <span class="instagram-sidebar__icon"><i class="fa fa-instagram"></i></span><h2 class="instagram-sidebar__title-text"><strong>#ELLE</strong>Vietnam</h2>
                                                            </div>
                                                                                            <div class="instagram-sidebar__item">
                                                                    <div class="instagram-sidebar__thumb"><a href="https://www.instagram.com/p/Bmicx9YHRLG/?hl=en&amp;tagged=ellevietnam" class="instagram-sidebar__link" target="_blank"><img src="https://www.elle.vn/wp-content/uploads/2017/04/14/elle-viet-nam-7-255x255.jpg" alt="" class="img-responsive"></a></div>
                                                                    <a href="https://www.instagram.com/p/Bmicx9YHRLG/?hl=en&amp;tagged=ellevietnam" class="instagram-sidebar__link" target="_blank">Instagram@ellevietnam</a>
                                                                </div>
                                                                                            <div class="instagram-sidebar__item">
                                                                    <div class="instagram-sidebar__thumb"><a href="https://www.instagram.com/p/BmoqA2bF_9h/?hl=en&amp;tagged=ellevietnam" class="instagram-sidebar__link" target="_blank"><img src="https://www.elle.vn/wp-content/uploads/2017/04/14/ELLE-viet-nam-6-255x255.jpg" alt="" class="img-responsive"></a></div>
                                                                    <a href="https://www.instagram.com/p/BmoqA2bF_9h/?hl=en&amp;tagged=ellevietnam" class="instagram-sidebar__link" target="_blank">instagram@anstanek</a>
                                                                </div>
                                                                                            <div class="instagram-sidebar__item">
                                                                    <div class="instagram-sidebar__thumb"><a href="https://www.instagram.com/p/BmFryqXFuBL/?hl=en&amp;tagged=ellevietnam" class="instagram-sidebar__link" target="_blank"><img src="https://www.elle.vn/wp-content/uploads/2017/04/14/ELLE-viet-nam-5-255x255.jpg" alt="" class="img-responsive"></a></div>
                                                                    <a href="https://www.instagram.com/p/BmFryqXFuBL/?hl=en&amp;tagged=ellevietnam" class="instagram-sidebar__link" target="_blank">instagram@sarahfordphoto</a>
                                                                </div>
                                                                                    </div>
                                                    </div>
                                                </div>
                                </div>