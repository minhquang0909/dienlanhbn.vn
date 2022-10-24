<?php
use common\components\CFunction;
use yii\helpers\Url;
?>


<footer id="footer" class="footer-wrapper">
    <section class="section footer-section" id="section_705798189">
        <div class="bg section-bg fill bg-fill  bg-loaded" >
        </div>
        <div class="section-content relative">
            <div class="row row-small"  id="row-18635382">
                <div id="col-687633293" class="col medium-6 small-12 large-6"  >
                    <div class="col-inner"  >
                        <div class="row row-small"  id="row-2018295422">
                            <div id="col-743091088" class="col giới-thiệu medium-6 small-12 large-6"  >
                                <div class="col-inner"  >
                                    <h4><span style="font-size: 95%;"><strong>Giới thiệu</strong></span></h4>
                                    <ul class="list-menu list-menu22">
                                        <li class="li_menu"><a href="<?=Url::to(['page/view','slug'=>'about'])?>"><span style="font-size: 85%;">Về Chúng Tôi</span></a></li>
                                        <li class="li_menu"><a href="<?=Url::to(['page/view','slug'=>'contact'])?>"><span style="font-size: 85%;">Liên hệ hợp tác</span></a></li>
                                        <li class="li_menu"><span style="font-size: 85%;"><a href="<?=Url::to(['page/view','slug'=>'policy'])?>">Quy định &amp; chính sách</a></span></li>
                                        <li class="li_menu"><span style="font-size: 85%;"><a href="<?=Url::to(['page/view','slug'=>'promotions'])?>">Các Chương Trình Khuyến Mãi</a></span></li>
                                    </ul>
                                </div>

                                <style>
                                    #col-743091088 > .col-inner {
                                        padding: 0px 0px 0 0px;
                                        margin: 0px 0px 10px 0px;
                                    }
                                </style>
                            </div>
                            <div id="col-1405183537" class="col gioi-thieu medium-6 small-12 large-6"  >
                                <div class="col-inner"  >
                                    <h4><span style="font-size: 95%;"><strong>Chính sách công ty</strong></span></h4>
                                    <ul class="list-menu list-menu22">
                                        <li class="li_menu"><a href="<?=Url::to(['page/view','slug'=>'order-method'])?>"><span style="font-size: 85%;">Hình thức đặt hàng</span></a></li>
                                        <li class="li_menu"><a href="<?=Url::to(['page/view','slug'=>'payment-method'])?>"><span style="font-size: 85%;">Hình thức thanh toán</span></a></li>
                                        <li class="li_menu"><span style="font-size: 85%;"><a href="<?=Url::to(['page/view','slug'=>'shipping-method'])?>">Phương thức vận chuyển</a></span></li>
                                        <li class="li_menu"><span style="font-size: 85%;"><a href="<?=Url::to(['page/view','slug'=>'returns-policy'])?>">Chính sách đổi trả hàng</a></span></li>
                                    </ul>
                                </div>
                                <style>
                                    #col-1405183537 > .col-inner {
                                        padding: 0px 0px 0 0px;
                                        margin: 0px 0px 0 0px;
                                    }
                                </style>
                            </div>
                            <style>
                                #row-2018295422 > .col > .col-inner {
                                    padding: 0px 0px 0 0px;
                                }
                            </style>
                        </div>

                    </div>
                </div>
                <div id="col-992895353" class="col medium-6 small-12 large-6"  >
                    <div class="col-inner" >
                        <div class="row row-small"  id="row-1461429773">
                            <div id="col-104334562" class="col medium-6 small-12 large-6"  >
                                <div class="col-inner"  >
                                    <h4><span style="font-size: 95%;"><strong>Hotline Đặt Hàng</strong></span></h4>
                                    <div class="icon-box featured-box icon-box-left text-left"  >
                                        <div class="icon-box-img" style="width: 60px">
                                            <div class="icon">
                                                <div class="icon-inner" >
                                                    <img width="53" height="40" src="<?=CFunction::getDomain()?>/img/icon-telephone.png" class="attachment-medium size-medium" alt="" loading="lazy" />                   </div>
                                            </div>
                                        </div>
                                        <div class="icon-box-text last-reset">

                                            <span style="color: #ff6600;"> <?=CFunction::getConfig('contact_phone')?>
                                            <span style="font-size: 80%; color: #808080;">(Tất cả các ngày trong tuần)</span></span>

                                        </div>
                                    </div>

                                    <div id="gap-1515634697" class="gap-element clearfix" style="display:block; height:auto;">

                                        <style>
                                            #gap-1515634697 {
                                                padding-top: 20px;
                                            }
                                        </style>
                                    </div>

                                    <h4><span style="font-size: 95%;"><strong>Kết nối với chúng tôi</strong></span></h4>
                                    <div class="social-icons follow-icons" ><a href="<?=CFunction::getConfig('contact_facebook')?>" target="_blank" data-label="Facebook" rel="noopener noreferrer nofollow" class="icon primary button circle facebook tooltip" title="Follow on Facebook" aria-label="Follow on Facebook">
                                            <i class="fab fa-facebook-f"></i></a><a href="<?=CFunction::getConfig('contact_instagram')?>" target="_blank" rel="noopener noreferrer nofollow" data-label="Instagram" class="icon primary button circle  instagram tooltip" title="Follow on Instagram" aria-label="Follow on Instagram">
                                            <i class="fab fa-instagram" aria-hidden="true"></i></a>
                                        <a href="mailto:<?=CFunction::getConfig('contact_email')?>" data-label="E-mail" rel="nofollow" class="icon primary button circle  email tooltip" title="Send us an email" aria-label="Send us an email">
                                            <i class="fa fa-envelope" ></i>
                                        </a>
                                        <a href="tel:<?=CFunction::getConfig('contact_phone')?>" target="_blank" data-label="Phone" rel="noopener noreferrer nofollow" class="icon primary button circle  phone tooltip" title="Call us" aria-label="Call us">
                                            <i class="fa fa-phone" ></i></a>
                                        <!--<a href="#" target="_blank" rel="noopener noreferrer nofollow" data-label="LinkedIn" class="icon primary button circle  linkedin tooltip" title="Follow on LinkedIn" aria-label="Follow on LinkedIn">
                                            <i class="fab fa-linkedin" ></i></a>-->
                                    </div>

                                    <div id="gap-611077336" class="gap-element clearfix" style="display:block; height:auto;">

                                        <style>
                                            #gap-611077336 {
                                                padding-top: 20px;
                                            }
                                        </style>
                                    </div>


                                </div>
                            </div>



                            <div id="col-144309890" class="col medium-6 small-12 large-6"  >
                                <div class="col-inner"  >


                                    <h4><span style="font-size: 95%;"><strong>Địa chỉ liên hệ</strong></span></h4>
                                    <strong><?=CFunction::getConfig('contact_location')?></strong>

                                    <span style="font-size: 12.24px;"><?=CFunction::getConfig('contact_address')?></span>

                                    <span style="font-size: 85%; color: #ff6600;"><?=CFunction::getConfig('contact_time')?></span>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>



            </div>

        </div>

    </section>

    <div class="absolute-footer dark medium-text-center small-text-center">
        <div class="container clearfix">
            <div class="footer-primary text-center">
                <div class="copyright-footer">
                    Copyright <?=date('Y')?> © <strong><a href="<?=Url::to(['site/index'])?>"><?=Yii::$app->name?></a></strong></div>
            </div>
        </div>
    </div>

    <a href="#top" class="back-to-top button icon invert plain fixed bottom z-1 is-outline hide-for-medium circle" id="top-link" aria-label="Go to top">
        <i class="far fa-angle-up" ></i></a>

    <div class="box_fixRight">
        <div class="box_content">
            <a target="_blank" href="tel: <?=CFunction::getConfig('contact_phone')?>" class="item item_1">Gọi Điện Thoại</a>
            <a target="_blank" href="https://zalo.me/<?=CFunction::getConfig('contact_zalo')?>" class="item item_2">Zalo</a>
            <a target="_blank" href="https://m.me/<?=CFunction::getConfig('contact_message')?>" class="item item_3">Facebook</a>
        </div>
    </div>
    <!--mobile quick link-->
    <div class="bottom-contact">
        <ul>
            <li>
                <a id="goidien" href="tel: <?=CFunction::getConfig('contact_phone')?>">
                    <img src="<?=CFunction::getDomain()?>/img/icon-phone2.png">
                    <br>
                    <span>Gọi điện</span>
                </a>
            </li>
            <li>
                <a id="nhantin" href="sms: <?=CFunction::getConfig('contact_phone2')?>">
                    <img src="<?=CFunction::getDomain()?>/img/icon-sms2.png">
                    <br>
                    <span>Nhắn tin</span>
                </a>
            </li>
            <li>
                <a id="chatzalo" href="https://zalo.me/<?=CFunction::getConfig('contact_zalo')?>">
                    <img src="<?=CFunction::getDomain()?>/img/icon-zalo2.png">
                    <br>
                    <span>Chat zalo</span>
                </a>
            </li>
            <li>
                <a id="chatfb" href="https://m.me/<?=CFunction::getConfig('contact_message')?>">
                    <img src="<?=CFunction::getDomain()?>/img/icon-mesenger2.png">
                    <br>
                    <span>Chat Facebook</span>
                </a>
            </li>
        </ul>
    </div>

</footer>


<script type='text/javascript' src='<?php echo CFunction::getDomain();?>/js/superfish.min.js'id='ot-superfish-js'></script>
<script type='text/javascript' src='<?php echo CFunction::getDomain();?>/js/ot-vertical-menu.min.js' id='ot-vertical-menu-js'></script>
<script type='text/javascript' id='flatsome-js-js-extra'>
    /* <![CDATA[ */
    var flatsomeVars = {"theme":{"version":"3.14.3"},"rtl":"","sticky_height":"54","lightbox":{"close_markup":"<button title=\"%title%\" type=\"button\" class=\"mfp-close\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" width=\"28\" height=\"28\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-x\"><line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"><\/line><line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"><\/line><\/svg><\/button>","close_btn_inside":false},"user":{"can_edit_pages":false},"i18n":{"mainMenu":"Main Menu"},"options":{"cookie_notice_version":"1","swatches_layout":false,"swatches_box_select_event":false,"swatches_box_behavior_selected":false,"swatches_box_update_urls":"1","swatches_box_reset":false,"swatches_box_reset_extent":false,"swatches_box_reset_time":300,"search_result_latency":"0"},"is_mini_cart_reveal":""};
    /* ]]> */
</script>
<script type='text/javascript' src='<?php echo CFunction::getDomain();?>/js/flatsome.js' id='flatsome-js-js'></script>

<script>
    var MP = window.MP || {};


    MP.number = {
        incrementValue: function(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
            if (!isNaN(currentVal)) {
                var max = parent.find('input[name=' + fieldName + ']').attr('max');
                if (currentVal < max) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                }
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        },
        decrementValue: function(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
            if (!isNaN(currentVal) && currentVal > 0) {
                var min = parent.find('input[name=' + fieldName + ']').attr('min');
                if (currentVal > min) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                }
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }
    }

    //
    $(document).ready(function(){
        $('.input-group-number input[name="quantity"]').change(function() {
            var max_val = parseInt($(this).attr('max'));
            var min_val = parseInt($(this).attr('min'));
            var val = $(this).val();
            var value = Math.min(max_val,Math.max(min_val,val));
            $(this).val(value);
        });

        $('.input-group-number').on('click', '.button-plus', function(e) {
            MP.number.incrementValue(e);
        });

        $('.input-group-number').on('click', '.button-minus', function(e) {
            MP.number.decrementValue(e);
        });
    });

    var addProductToCartObj;
    //
    function addProductToCart(id, quantity, url){
        addProductToCartObj = $.ajax({
            url: url,
            type: "POST",
            dataType:'json',
            data: {
                'id' : id,
                'quantity' : quantity,
                '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
            },
            success: function(res)
            {
                if(res.status==1) {
                    window.location.href = res.url;
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: ''+res.message+'',
                    });
                }
            },
            error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                Swal.fire({
                    icon: 'error',
                    text: ''+errorMessage+'',
                });
            }
        });
    }
</script>