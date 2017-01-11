<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="entry-title"><span>{{ title }}</span></h2>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <!-- Start Blog Posts -->
            <div class="col-md-9">
                {% if pages %}
                    <!-- Start Post -->
                    {% for page in pages %}
                        <div class="blog-post">
                            <!-- Post thumb -->
                            <div class="post-thumb">
                                {% if page.image %}
                                    <a href="{{ url("upload/"~page.image) }}">{{ image("upload/"~page.image) }}</a>
                                {% else %}
                                    <a href="{{ url("theme/assets/img/news/siswa.jpg") }}">{{ image("theme/assets/img/news/siswa.jpg") }}</a>
                                {% endif %}
                                <div class="hover-wrap">
                                    <div class="link">
                                        {% if page.image %}
                                        <a href="{{ url("upload/"~page.image) }}"><i class="icon-link"></i></a>
                                        <a class="lightbox" href="{{ url("upload/"~page.image) }}"><i class="icon-size-fullscreen"></i></a>
                                        {% else %}
                                        <a href="{{ page.slug }}"><i class="icon-link"></i></a>
                                        <a class="lightbox" href="{{ url("theme/assets/img/news/siswa.jpg") }}"><i class="icon-size-fullscreen"></i></a>
                                        {% endif %}
                                    </div>
                                </div>
                            </div>
                            <!-- End Post post-thumb -->

                            <!-- Post Date -->
                            <div class="date">
                                <p> {{ tags.date(page.created) }} </p>
                            </div>
                            <!-- Post End -->

                            <!-- Post Content -->
                            <div class="post-content">
                                <h3 class="post-title"><a href="#">{{ page.title }}</a></h3>
                                <div class="meta">
                                    <span class="meta-part"><i class="icon-clock"></i> <a href="#">{{ tags.indo(page.created) }}</a></span>
                                    <span class="meta-part"><a href="#"><i class="icon-user"></i> {{ page.users.name }}</a></span>
                                    {#<span class="meta-part"><a href="#"><i class="icon-speech"></i> 03</a></span>#}
                                    <span class="meta-part"><a href="#"><i class="icon-heart"></i> {% if page.views.views is defined %} {{ page.views.views }} {% else %} 0 {% endif %}</a></span>
                                    {#<span class="meta-part"><a href="#"><i class="icon-tag"></i> Design</a></span>#}
                                </div>
                                {{ page.content }}
                                <ul class="social-list">
                                    <li>
                                        <a href="https://www.facebook.com/sharer.php?t={{ page.title }}!&amp;u={{ url("http://www.kabarindonesiapintar.com/"~page.categories.slug~"/"~page.slug) }}" class="social-link facebook" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook" onclick="window.open(this.href, 'social-link facebook', 'width=550,height=255');return false;"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/share?text={{ page.title }}!&amp;url={{ url("http://www.kabarindonesiapintar.com/"~page.categories.slug~"/"~page.slug) }}" class="social-link twitter" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Twitter" onclick="window.open(this.href, 'social-link facebook', 'width=550,height=255');return false;"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url={{ url("http://www.kabarindonesiapintar.com/"~page.categories.slug~"/"~page.slug) }}" class="social-link google" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Google Plus" onclick="window.open(this.href, 'social-link facebook', 'width=550,height=255');return false;"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url("http://www.kabarindonesiapintar.com/"~page.categories.slug~"/"~page.slug) }}&title={{ page.title }}" class="social-link linkdin" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Linkedin" onclick="window.open(this.href, 'social-link facebook', 'width=550,height=255');return false;"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Post Content -->
                        </div>
                    {% endfor %}
                    <!-- End Post -->
                {% else %}
                    <div class="blog-post">
                        <div class="post-content">
                            <h3 class="post-title">{{ title }} Masih Kosong</h3>
                        </div>
                    </div>
                {% endif %}

            </div>
            <!-- End Blog Posts -->
            <aside id="sidebar" class="col-md-3 right-sidebar">
                <!-- Categories Widget -->
                <div class="widget widget-categories">
                    <h5 class="widget-title">KATEGORI</h5>
                    <ul class="cat-list">
                        {% if category %}
                            {% for cat in category %}
                                <li>
                                    <a href="{{ url("pages/"~cat.slug) }}">{{ cat.name }} </a>
                                </li>
                            {% endfor %}
                        {% endif %}
                    </ul>
                </div>

                <!-- Popular Posts widget -->
                <div class="widget widget-popular-posts">
                    <h5 class="widget-title">Tulisan Terbaru</h5>
                    <ul class="posts-list">
                        {% if latest %}
                            {% for item in latest %}
                                <li>
                                    <div class="widget-thumb">
                                        {% if item.image %}
                                            <a href="#">{{ image("upload/"~item.image) }}</a>
                                        {% else %}
                                            <a href="#">{{ image("theme/assets/img/partners/student.png") }}</a>
                                        {% endif %}
                                    </div>
                                    <div class="widget-content">
                                        <a href="{{ url(item.categories.slug~"/"~item.slug) }}">{{ item.title }}</a>
                                        <span><i class="icon-calendar"></i> {{ tags.indo(item.created) }}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            {% endfor %}
                        {% endif %}
                    </ul>
                </div>

            </aside>
            <!--End sidebar-->
        </div>
    </div>
</div>
