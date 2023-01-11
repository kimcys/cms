<form name="lokasi" id="lokasi" method="post" class="form-horizontal" onsubmit="return false">
                    <div id="divLokasi" class="row">    
                        <?php
                        ViewLokasi::form_lokasi($_REQUEST);
                        ?>
                    </div>
                </form>