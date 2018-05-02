<template>
    <section id="main-section" class="section">
        <div class="container">
            <div class="row">
                <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 order-sm-2 col-sm-12 col-12 order-2">
                    <div class="white-block new-post">
                        <div class="new-post--header">
                            <h3 class="new-post--header--title">
                                <!--<span>-->
                                <!--<svg class="icon icon-newspaper">-->
                                <!--<use xlink:href="#icon-newspaper"></use>-->
                                <!--</svg>-->
                                <!--</span>-->
                                Add new post
                            </h3>
                            <span class="new-post--header--more">
                            <svg class="icon icon-more-button">
                                <use xlink:href="#icon-more-button"></use>
                            </svg>
                        </span>
                        </div>
                        <div class="new-post--field">
                            <form>
                                <img src="img/bg.jpg" alt="">
                                <textarea placeholder="Share what you are thinking here ..."></textarea>
                                <div class="new-post--add-photo">
                                    <label>
                                        <input type="file" multiply accept="image/*">
                                        <svg class="icon icon-photo-camera">
                                            <use xlink:href="#icon-photo-camera"></use>
                                        </svg>
                                    </label>
                                </div>
                                <div class="new-post--control">
                                    <div class="new-post--select-files">
                                        <div class="new-post--select-files--file">
                                            <label>
                                                <input type="file" multiply accept="image/*">
                                                <svg class="icon icon-photo-camera">
                                                    <use xlink:href="#icon-photo-camera"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="new-post--select-files--file">
                                            <label>
                                                <input type="file" multiply accept="video/*">
                                                <svg class="icon icon-video-player">
                                                    <use xlink:href="#icon-video-player"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="new-post--select-files--file">
                                            <label>
                                                <input type="file" multiply accept="audio/*">
                                                <svg class="icon icon-musical-note">
                                                    <use xlink:href="#icon-musical-note"></use>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-green">
                                        Add post
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="newsfeed-items-grid">
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="white-block">
                            <article class="post">
                                <div class="post--author">
                                    <div class="post--author-user">
                                        <img src="img/bg.jpg" alt="author">
                                        <div class="post--author-date">
                                            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
                                            <!--<span class="share">shared-->
                                            <!--a <a href="#">link</a></span>-->
                                            <div class="post--date">
                                                <time class="published" datetime="2018-05-1T15:18">
                                                    <a href="#">@teleblog</a> May 1 at 2:05pm
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="icon icon-more-button">
                                            <use xlink:href="#icon-more-button"></use>
                                        </svg>
                                        <ul class="more-dropdown d-none">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
                                    facere
                                    fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
                                    assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
                                    doloribus
                                    eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
                                    harum
                                    impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
                                    numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
                                    architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
                                    impedit
                                    labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
                                    voluptatibus. A
                                    animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
                                    sapiente voluptates?</p>
                                <div class="post-additional-info">
                                    <div class="post-like">
                                        <a href="#" class="post-add-icon">
                                            <svg class="icon icon-heart">
                                                <use xlink:href="#icon-heart"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                        <ul class="friends-like">
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="img/bg.jpg" alt="friend">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="names-people-likes">
                                            <a href="#">You</a>, <a href="#">Elaine</a> and
                                            <br>22 more liked this
                                        </div>
                                    </div>
                                    <div class="post-comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-chat-comment">
                                                <use xlink:href="#icon-chat-comment"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="icon icon-reply-all">
                                                <use xlink:href="#icon-reply-all"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>
                </main>
                <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 order-sm-3 col-sm-12 col-12 order-3">
                    <div class="white-block">
                        <div class="white-block-title">
                            <h6 class="title">Add chanel</h6>
                            <a href="#" class="more">
                                <svg class="icon icon-more-button">
                                    <use xlink:href="#icon-more-button"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </aside>
                <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-12 order-sm-1 col-sm-12 col-12 order-1">
                    <div class="white-block">
                        <div class="white-block-title">
                            <h6 class="title">Add chanel</h6>
                            <a href="#" class="more">
                                <svg class="icon icon-more-button">
                                    <use xlink:href="#icon-more-button"></use>
                                </svg>
                            </a>
                        </div>
                        <ul class="widget--chanel">
                            <li class="inline-items">
                                <div class="sn">
                                    <div class="sn-thumb">
                                        <svg class="icon icon-telegram">
                                            <use xlink:href="#icon-telegram"></use>
                                        </svg>
                                    </div>
                                    <div class="sn-event">
                                        <p>Telegram</p>
                                    </div>
                                </div>
                                <span class="notification-icon">
							<a href="#" class="btn btn-accept">
								<span class="icon-add without-text">
                                     <svg class="icon icon-add">
                                        <use xlink:href="#icon-add"></use>
                                    </svg>
								</span>
							</a>
						</span>
                            </li>
                            <li class="inline-items">
                                <div class="sn">
                                    <div class="sn-thumb">
                                        <svg class="icon icon-twitter-bird-logo">
                                            <use xlink:href="#icon-twitter-bird-logo"></use>
                                        </svg>
                                    </div>
                                    <div class="sn-event">
                                        <p>Twitter</p>
                                    </div>
                                </div>
                                <span class="notification-icon">
							<a href="#" class="btn btn-login">
								<span class="icon-add without-text">
                                     <!--<svg class="icon icon-login">-->
                                    <!--<use xlink:href="#icon-login"></use>-->
                                    <!--</svg>-->
                                    login
								</span>
							</a>
						</span>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
        <div class="white-block column-friends">
            <ul class="column-friends-list">
                <li class="column-friends-list-item">1</li>
                <li class="column-friends-list-item">2</li>
                <li class="column-friends-list-item">3</li>
                <li class="column-friends-list-item">4</li>
                <li class="column-friends-list-item">5</li>
                <li class="column-friends-list-item">6</li>
                <li class="column-friends-list-item">7</li>
                <li class="column-friends-list-item">8</li>
                <li class="column-friends-list-item">9</li>
                <li class="column-friends-list-item">10</li>
            </ul>

        </div>
    </section>
</template>

<script>
    export default {
        name: "Test",
        computed: {
            user() {
                return this.$store.getters.user
            }
        },
        methods: {},
        mounted() {

        }
    }
</script>

<style scoped>

</style>