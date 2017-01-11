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
                {% if(page.items) %}
                    {% for pages in page.items %}
                        <!-- Start Post -->
                        <div class="blog-post">
                            <!-- Post thumb -->
                            {% if pages.image %}
                            <div class="post-thumb">
                                <a href="{{ url("upload/"~pages.image) }}">{{ image("upload/"~pages.image) }}</a>
                                <div class="hover-wrap">
                                    <div class="link">
                                        <a href="{{ pages.slug }}"><i class="icon-link"></i></a>
                                        <a class="lightbox" href="{{ url("upload/"~pages.image) }}"><i class="icon-size-fullscreen"></i></a>
                                    </div>
                                </div>
                            </div>
                            {% else %}
                            <div class="post-thumb">
                                <a href="#">{{ image("theme/assets/img/news/siswa.jpg") }}</a>
                                <div class="hover-wrap">
                                    <div class="link">
                                        <a href="{{ pages.slug }}"><i class="icon-link"></i></a>
                                        <a class="lightbox" href="{{ url("theme/assets/img/news/siswa.jpg") }}"><i class="icon-size-fullscreen"></i></a>
                                    </div>
                                </div>
                            </div>
                            {% endif %}
                            <!-- End Post post-thumb -->

                            <!-- Post Date -->
                            <div class="date">
                                <p> {{ tags.date(pages.created) }} </p>
                            </div>
                            <!-- Post End -->

                            <!-- Post Content -->
                            <div class="post-content">
                                <h3 class="post-title"><a href="{{ url(pages.categories.slug~"/"~pages.slug)  }}">{{ pages.title }}</a></h3>
                                <div class="meta">
                                    <span class="meta-part"><i class="icon-clock"></i> <a href="#">{{ tags.indo(pages.created) }}</a></span>
                                    <span class="meta-part"><a href="#"><i class="icon-user"></i> {{ pages.users.name }}</a></span>
                                    {#<span class="meta-part"><a href="#"><i class="icon-speech"></i> 03</a></span>#}
                                    <span class="meta-part"><a href="#"><i class="icon-heart"></i> {% if pages.views.views is defined %} {{ pages.views.views }} {% else %} 0 {% endif %}</a></span>
                                    {#<span class="meta-part"><a href="#"><i class="icon-tag"></i> Design</a></span>#}
                                </div>
                                {{ tags.substr(pages.content,0,1000) }}
                                <p><a href="{{ url(pages.categories.slug~"/"~pages.slug)  }}" class="btn btn-effect"> Selengkapnya <i class="fa fa-long-arrow-right"></i></a></p>
                            </div>
                            <!-- Post Content -->

                        </div>
                        <!-- End Post -->
                    {% endfor %}
                    <!-- Start Pagination -->
                    <div id="pagination">
                        <span class="current page-num"><i class="icon-fast-backward"></i> Awal </span>
                        <a class="next-page" href="{{ url }}?p={{ page.before }}"><i class="icon-step-backward"></i> Sebelumnya</a>
                        <a class="next-page" href="{{ url }}?p={{ page.next }}"><i class="icon-step-forward"></i> Selanjutnya</a>
                        <a class="next-page" href="{{ url }}?p={{ page.last }}"><i class="icon-fast-forward"></i> Akhir</a>
                        <a class="next-page" href="#">{{ page.current }} / {{ page.total_pages }}</a>
                    </div>
                    <!-- End Pagination -->
                {% else %}
                    <div class="blog-post">
                        <div class="post-content">
                            <h3 class="post-title">{{ title }} Masih Kosong</h3>
                        </div>
                    </div>
                {% endif %}
            </div>
            <!-- End Blog Posts -->
            <!--Sidebar-->
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