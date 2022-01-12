<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Pagination
            <div class="pull-right btn-add">
                <span class="label label-danger">Total entries: <?php echo $totalItem; ?></span>
                <span class="label label-warning">Total page:  <?php echo $objPagination->getTotalPage() ; ?></span>
            </div>
        </h3>
    </div>
    <div class="panel-body info-pagination">
        <div class="col-md-6">
            <p class="text-left">Number of element on the page: 
                <b class="text-hightlight"><?php echo $configPagination['totalItemsPerPage']; ?></b>
            </p>
            <p class="text-left">Showing 
                <b class="text-hightlight"> <?php echo (($paramsCurrentPage-1)*$configPagination['totalItemsPerPage'] + 1) ?> </b> 
                to 
                <b class="text-hightlight"> <?php echo ($paramsCurrentPage*$configPagination['totalItemsPerPage'] > $totalItem) ? $totalItem : $paramsCurrentPage*$configPagination['totalItemsPerPage'];?> </b> 
                of
                <b class="text-hightlight"> <?php echo $totalItem; ?> </b> 
                entries
            </p>
        </div>
        <div class="col-md-6 content-pagination">
            <?php echo $objPagination->showPagination(); ?>			
        </div>
    </div>
</div>