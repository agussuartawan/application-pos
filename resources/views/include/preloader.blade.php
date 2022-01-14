<style>
    #overlay {
    position: absolute; /* Sit on top of the page content */
    display: none; /*Hidden by default*/
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999; /* Specify a stack order in case you're using a different order for other elements */
}
</style>
<div id="overlay" class="preloader">
    <div class="row align-items-center h-100">
        <div class="col-6 mx-auto">
            <div class="d-flex justify-content-center">
                <i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;"></i>
            </div>
        </div>
    </div>
</div> 