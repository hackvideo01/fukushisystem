<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">ページネーション
            <div class="pull-right btn-add">
                <span class="label label-danger">エントリー総数： <?php echo $totalItem; ?></span>
                <span class="label label-warning">総ページ： <?php echo $objPagination->getTotalPage() ; ?></span>
            </div>
        </h3>
    </div>
    <div class="panel-body info-pagination">
        <div class="col-md-6">
            <p class="text-left">ページ上の要素の数： 
                <b class="text-hightlight"><?php echo $configPagination['totalItemsPerPage']; ?></b>
            </p>
            <p class="text-left">表示中 
                <b class="text-hightlight"> <?php echo (($paramsCurrentPage-1)*$configPagination['totalItemsPerPage'] + 1) ?> </b> 
                まで 
                <b class="text-hightlight"> <?php echo ($paramsCurrentPage*$configPagination['totalItemsPerPage'] > $totalItem) ? $totalItem : $paramsCurrentPage*$configPagination['totalItemsPerPage'];?> </b> 
                の
                <b class="text-hightlight"> <?php echo $totalItem; ?> </b> 
                エントリ
            </p>
        </div>
        <div class="col-md-6 content-pagination">
            <?php echo $objPagination->showPagination(); ?>			
        </div>
    </div>
</div>