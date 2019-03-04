 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
						<div class="row">
							<div class="col-lg-12">
								<h1>Pages</h1>
							</div>
						</div>
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All pages
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div  role="status" aria-live="polite" style="padding-top: 8px;"><?php //echo $pagination_text;?></div>
								</div>
								<div class="col-sm-6 text-right">	
										<?php //echo $pagination;?>									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table width="100%" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>												
												<th>Name</th>
												<th>Slug</th>
												<th>Content</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($pages)){
												foreach($pages as $page){
											?>
											<tr class="odd gradeX">
												<td><?php echo $page->name;?></td>
												<td><?php echo $page->slug;?></td>
												<td><?php echo substr(strip_tags($page->content),0,50);?></td>
												<td class="center;">
													<a href="<?php echo site_url('/page/edit/').$page->page_id;?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;
													<!--<a href="<?php echo site_url('/page/delete/').$page->page_id;?>" title="Delete" class="delete-confirm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>-->
													<a target="_blank" href="<?php echo dirname(site_url()).'/'.$page->slug;?>" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;
												</td>
											</tr>
											<?php 
												}
											} ?>
										</tbody>
									</table><!-- /.table-responsive -->
								</div>
							</div>
                            <div class="row">
								<div class="col-sm-6">
									<div  role="status" aria-live="polite" style="padding-top: 8px;"><?php //echo $pagination_text;?></div>
								</div>
								<div class="col-sm-6 text-right">	
										<?php //echo $pagination;?>									
								</div>
							</div>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
        </div>
        <!-- /#page-wrapper -->