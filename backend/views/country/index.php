<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Country */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Countries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a id="btn_delete_country" href="javascript:void(0);" class="btn btn-danger" title="Xóa nhiều quốc gia"><i class="fa fa-trash"></i> Xóa</a>&nbsp;&nbsp;
        <?php echo Html::a(Yii::t('backend', 'Create country'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin()?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive',
            'id'    =>  'country-grid'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function($model) {

                        return ['value' => $model->id, 'class' => 'checkbox-row','id'=>'checkbox'];

                    }
            ],

            //'id',
            'name',
            'name_en',
            'code',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ],
    ]); ?>
    <?php Pjax::end()?>
</div>

<input type="hidden" id="country_id_delete" value=""/>
<script>
    $(document).ready(function(){
        $(document).on('change', '.select-on-check-all, .checkbox-row', function() {
            var keys = $('#country-grid').yiiGridView('getSelectedRows');
            $('#country_id_delete').val(keys);
        });
        //
        $('#btn_delete_country').click(function () {
            var country_id_delete = $('#country_id_delete').val();
            if(country_id_delete!=""){
                Swal.fire({
                    text: "Bạn có muốn xóa những quốc gia này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //
                    if (result.isConfirmed) {
                        deleteCountries(country_id_delete);
                    };
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Vui lòng chọn quốc gia cần xóa',
                });
            }
        });
    });
    var deleteCountriesClick=0;
    function deleteCountries(country_id_string) {
        if(deleteCountriesClick==0){
            deleteCountriesClick++;
            $.ajax({
                url: '<?=Url::to(['country/delete-multi'])?>',
                type: "POST",
                dataType:'json',
                data: {
                    'country_id_string': country_id_string,
                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->csrfToken?>'
                },
                success: function(res)
                {
                    deleteCountriesClick=0;
                    $('#supplier_id_delete').val("");
                    if(res.status==1) {
                        Swal.fire(
                            'Thành công!',
                            '' + res.message + '',
                            'success'
                        );
                        jQuery.pjax.reload({container:'#p0'});
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
    }
</script>
