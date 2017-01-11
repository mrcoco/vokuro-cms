<style>
    .form-control {
        height: 43px;
    }
</style>
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="entry-title">Indexs Berita</h2>
            </div>
        </div>
    </div>
</div>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Start Big Title -->
                <!-- Accordion -->
                <div class="panel-group" id="accordion">
                    <!-- Start Accordion 1 -->
                    <div class="panel panel-default">
                        <!-- Toggle Heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse-1">
                                    Daftar Index Berita
                                </a>
                            </h4>
                        </div>
                        <!-- Toggle Content -->
                        <div id="collapse-1" class="panel-collapse collapse in">
                            <div class="panel-body" style="padding-top: 20px;">
                                <form action="{{ url("indexs") }}" method="post">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <input type='text' id="sandbox-container" name="created" class="form-control" />
                                        </div>
                                        <div class="col-xs-9">
                                            <button type="submit" class="btn btn-effect"><i class="fa fa-check"></i> Tampil</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <div id="index-result">
                                    {% for pages in page.items %}
                                        <div class="partners-text">
                                            <h3><a href="{{ url(pages.categories.slug~"/"~pages.slug) }}">{{ pages.title }}</a></h3>
                                            <span class="date" style="color: #959595;"><i class="fa fa-file-text-o"> </i>  {{ tags.indo(pages.created) }}</span>
                                            {{ tags.substr(pages.content,0,200) }}
                                        </div>
                                    {% endfor %}

                                    <!-- Start Pagination -->
                                    <div id="pagination" style="padding-top: 20px;">
                                        <span class="current page-num"><i class="icon-fast-backward"></i> Awal</span>
                                        <a class="next-page" href="{{ url("indexs") }}?page={{ page.before }}"><i class="icon-step-backward"></i> Sebelumnya</a>
                                        <a class="next-page" href="{{ url("indexs") }}?page={{ page.next }}"><i class="icon-step-forward"></i> Selanjutnya</a>
                                        <a class="next-page" href="{{ url("indexs") }}?page={{ page.last }}"><i class="icon-fast-forward"></i> Akhir</a>
                                        <a class="next-page" href="#">{{ page.current }} / {{ page.total_pages }}</a>
                                    </div>
                                    <!-- End Pagination -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Accordion 1 -->
                </div>
                <!-- End Accordion -->
            </div>
        </div>
    </div>
</section>