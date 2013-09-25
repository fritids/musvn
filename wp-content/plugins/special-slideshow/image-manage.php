<div class="wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br></div><h2>Image <a href="post-new.php" class="add-new-h2">Add New</a></h2>
    <ul class="subsubsub">
        <li class="all"><a href="edit.php?post_type=post" class="current">All <span class="count">(1)</span></a> |</li>
        <li class="publish"><a href="edit.php?post_status=publish&amp;post_type=post">Published <span class="count">(1)</span></a></li>
    </ul>
    <form id="posts-filter" action="" method="get">

        <p class="search-box">
            <label class="screen-reader-text" for="post-search-input">Search Posts:</label>
            <input type="search" id="post-search-input" name="s" value="">
            <input type="submit" name="" id="search-submit" class="button" value="Search Posts"></p>

        <input type="hidden" name="post_status" class="post_status_page" value="all">
        <input type="hidden" name="post_type" class="post_type_page" value="post">

        <input type="hidden" id="_wpnonce" name="_wpnonce" value="bd0f26addd"><input type="hidden" name="_wp_http_referer" value="/wp-admin/edit.php">	<div class="tablenav top">

            <div class="alignleft actions">
                <select name="action">
                    <option value="-1" selected="selected">Bulk Actions</option>
                    <option value="edit" class="hide-if-no-js">Edit</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <input type="submit" name="" id="doaction" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
                <select name="cat" id="cat" class="postform">
                    <option value="0">View all categories</option>
                    <option class="level-0" value="1">Uncategorized</option>
                </select>
                <input type="submit" name="" id="post-query-submit" class="button" value="Filter">		
            </div>
            <div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
                <span class="pagination-links"><a class="first-page disabled" title="Go to the first page" href="http://wp.local/wp-admin/edit.php">«</a>
                    <a class="prev-page disabled" title="Go to the previous page" href="http://wp.local/wp-admin/edit.php?paged=1">‹</a>
                    <span class="paging-input"><input class="current-page" title="Current page" type="text" name="paged" value="1" size="1"> of <span class="total-pages">1</span></span>
                    <a class="next-page disabled" title="Go to the next page" href="http://wp.local/wp-admin/edit.php?paged=1">›</a>
                    <a class="last-page disabled" title="Go to the last page" href="http://wp.local/wp-admin/edit.php?paged=1">»</a></span></div>		<input type="hidden" name="mode" value="list">
            <div class="view-switch">
                <a href="/wp-admin/edit.php?mode=list" class="current"><img id="view-switch-list" src="http://wp.local/wp-includes/images/blank.gif" width="20" height="20" title="List View" alt="List View"></a>
                <a href="/wp-admin/edit.php?mode=excerpt"><img id="view-switch-excerpt" src="http://wp.local/wp-includes/images/blank.gif" width="20" height="20" title="Excerpt View" alt="Excerpt View"></a>
            </div>

            <br class="clear">
        </div>
        <table class="wp-list-table widefat fixed posts" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" id="cb" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th><th scope="col" id="title" class="manage-column column-title sortable desc" style=""><a href="http://wp.local/wp-admin/edit.php?orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th><th scope="col" id="author" class="manage-column column-author" style="">Author</th><th scope="col" id="categories" class="manage-column column-categories" style="">Categories</th><th scope="col" id="tags" class="manage-column column-tags" style="">Tags</th><th scope="col" id="comments" class="manage-column column-comments num sortable desc" style=""><a href="http://wp.local/wp-admin/edit.php?orderby=comment_count&amp;order=asc"><span><span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span></span><span class="sorting-indicator"></span></a></th><th scope="col" id="date" class="manage-column column-date sortable asc" style=""><a href="http://wp.local/wp-admin/edit.php?orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>	</tr>
            </thead>

            <tfoot>
                <tr>
                    <th scope="col" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"></th><th scope="col" class="manage-column column-title sortable desc" style=""><a href="http://wp.local/wp-admin/edit.php?orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th><th scope="col" class="manage-column column-author" style="">Author</th><th scope="col" class="manage-column column-categories" style="">Categories</th><th scope="col" class="manage-column column-tags" style="">Tags</th><th scope="col" class="manage-column column-comments num sortable desc" style=""><a href="http://wp.local/wp-admin/edit.php?orderby=comment_count&amp;order=asc"><span><span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span></span><span class="sorting-indicator"></span></a></th><th scope="col" class="manage-column column-date sortable asc" style=""><a href="http://wp.local/wp-admin/edit.php?orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>	</tr>
            </tfoot>

            <tbody id="the-list">
                <tr id="post-1" class="post-1 type-post status-publish format-standard hentry category-uncategorized alternate iedit author-self" valign="top">
                    <th scope="row" class="check-column">
                        <label class="screen-reader-text" for="cb-select-1">Select Hello world!</label>
                        <input id="cb-select-1" type="checkbox" name="post[]" value="1">
            <div class="locked-indicator"></div>
            </th>
            <td class="post-title page-title column-title"><strong><a class="row-title" href="http://wp.local/wp-admin/post.php?post=1&amp;action=edit" title="Edit “Hello world!”">Hello world!</a></strong>
                <div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
                <div class="row-actions"><span class="edit"><a href="http://wp.local/wp-admin/post.php?post=1&amp;action=edit" title="Edit this item">Edit</a> | </span><span class="inline hide-if-no-js"><a href="#" class="editinline" title="Edit this item inline">Quick&nbsp;Edit</a> | </span><span class="trash"><a class="submitdelete" title="Move this item to the Trash" href="http://wp.local/wp-admin/post.php?post=1&amp;action=trash&amp;_wpnonce=d88147f2a7">Trash</a> | </span><span class="view"><a href="http://wp.local/uncategorized/hello-world" title="View “Hello world!”" rel="permalink">View</a></span></div>
                <div class="hidden" id="inline_1">
                    <div class="post_title">Hello world!</div>
                    <div class="post_name">hello-world</div>
                    <div class="post_author">1</div>
                    <div class="comment_status">open</div>
                    <div class="ping_status">open</div>
                    <div class="_status">publish</div>
                    <div class="jj">20</div>
                    <div class="mm">09</div>
                    <div class="aa">2013</div>
                    <div class="hh">02</div>
                    <div class="mn">58</div>
                    <div class="ss">33</div>
                    <div class="post_password"></div><div class="post_category" id="category_1">1</div><div class="tags_input" id="post_tag_1"></div><div class="sticky"></div><div class="post_format"></div></div></td>			<td class="author column-author"><a href="edit.php?post_type=post&amp;author=1">admin</a></td>
            <td class="categories column-categories"><a href="edit.php?category_name=uncategorized">Uncategorized</a></td><td class="tags column-tags">—</td>			<td class="comments column-comments"><div class="post-com-count-wrapper">
                    <a href="http://wp.local/wp-admin/edit-comments.php?p=1" title="0 pending" class="post-com-count"><span class="comment-count">1</span></a>			</div></td>
            <td class="date column-date"><abbr title="2013/09/20 2:58:33 AM">2013/09/20</abbr><br>Published</td>		</tr>
            </tbody>
        </table>
        <div class="tablenav bottom">

            <div class="alignleft actions">
                <select name="action2">
                    <option value="-1" selected="selected">Bulk Actions</option>
                    <option value="edit" class="hide-if-no-js">Edit</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <input type="submit" name="" id="doaction2" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
            </div>
            <div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
                <span class="pagination-links"><a class="first-page disabled" title="Go to the first page" href="http://wp.local/wp-admin/edit.php">«</a>
                    <a class="prev-page disabled" title="Go to the previous page" href="http://wp.local/wp-admin/edit.php?paged=1">‹</a>
                    <span class="paging-input">1 of <span class="total-pages">1</span></span>
                    <a class="next-page disabled" title="Go to the next page" href="http://wp.local/wp-admin/edit.php?paged=1">›</a>
                    <a class="last-page disabled" title="Go to the last page" href="http://wp.local/wp-admin/edit.php?paged=1">»</a></span></div>
            <br class="clear">
        </div>

    </form>


    <form method="get" action=""><table style="display: none"><tbody id="inlineedit">

                <tr id="inline-edit" class="inline-edit-row inline-edit-row-post inline-edit-post quick-edit-row quick-edit-row-post inline-edit-post" style="display: none"><td colspan="7" class="colspanchange">

                        <fieldset class="inline-edit-col-left"><div class="inline-edit-col">
                                <h4>Quick Edit</h4>

                                <label>
                                    <span class="title">Title</span>
                                    <span class="input-text-wrap"><input type="text" name="post_title" class="ptitle" value=""></span>
                                </label>

                                <label>
                                    <span class="title">Slug</span>
                                    <span class="input-text-wrap"><input type="text" name="post_name" value=""></span>
                                </label>


                                <label><span class="title">Date</span></label>
                                <div class="inline-edit-date">
                                    <div class="timestamp-wrap"><select name="mm">
                                            <option value="01">01-Jan</option>
                                            <option value="02">02-Feb</option>
                                            <option value="03">03-Mar</option>
                                            <option value="04">04-Apr</option>
                                            <option value="05">05-May</option>
                                            <option value="06">06-Jun</option>
                                            <option value="07">07-Jul</option>
                                            <option value="08">08-Aug</option>
                                            <option value="09" selected="selected">09-Sep</option>
                                            <option value="10">10-Oct</option>
                                            <option value="11">11-Nov</option>
                                            <option value="12">12-Dec</option>
                                        </select> <input type="text" name="jj" value="20" size="2" maxlength="2" autocomplete="off">, <input type="text" name="aa" value="2013" size="4" maxlength="4" autocomplete="off"> @ <input type="text" name="hh" value="02" size="2" maxlength="2" autocomplete="off"> : <input type="text" name="mn" value="58" size="2" maxlength="2" autocomplete="off"></div><input type="hidden" id="ss" name="ss" value="33">			</div>
                                <br class="clear">

                                <label class="inline-edit-author"><span class="title">Author</span><select name="post_author" class="authors">
                                        <option value="1">admin</option>
                                    </select></label>
                                <div class="inline-edit-group">
                                    <label class="alignleft">
                                        <span class="title">Password</span>
                                        <span class="input-text-wrap"><input type="text" name="post_password" class="inline-edit-password-input" value=""></span>
                                    </label>

                                    <em style="margin:5px 10px 0 0" class="alignleft">
                                        –OR–				</em>
                                    <label class="alignleft inline-edit-private">
                                        <input type="checkbox" name="keep_private" value="private">
                                        <span class="checkbox-title">Private</span>
                                    </label>
                                </div>


                            </div></fieldset>


                        <fieldset class="inline-edit-col-center inline-edit-categories"><div class="inline-edit-col">


                                <span class="title inline-edit-categories-label">Categories</span>
                                <input type="hidden" name="post_category[]" value="0">
                                <ul class="cat-checklist category-checklist">

                                    <li id="category-1" class="popular-category"><label class="selectit"><input value="1" type="checkbox" name="post_category[]" id="in-category-1"> Uncategorized</label></li>
                                </ul>


                            </div></fieldset>


                        <fieldset class="inline-edit-col-right"><div class="inline-edit-col">



                                <label class="inline-edit-tags">
                                    <span class="title">Tags</span>
                                    <textarea cols="22" rows="1" name="tax_input[post_tag]" class="tax_input_post_tag"></textarea>
                                </label>




                                <div class="inline-edit-group">
                                    <label class="alignleft">
                                        <input type="checkbox" name="comment_status" value="open">
                                        <span class="checkbox-title">Allow Comments</span>
                                    </label>
                                    <label class="alignleft">
                                        <input type="checkbox" name="ping_status" value="open">
                                        <span class="checkbox-title">Allow Pings</span>
                                    </label>
                                </div>


                                <div class="inline-edit-group">
                                    <label class="inline-edit-status alignleft">
                                        <span class="title">Status</span>
                                        <select name="_status">
                                            <option value="publish">Published</option>
                                            <option value="future">Scheduled</option>
                                            <option value="pending">Pending Review</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </label>



                                    <label class="alignleft">
                                        <input type="checkbox" name="sticky" value="sticky">
                                        <span class="checkbox-title">Make this post sticky</span>
                                    </label>



                                </div>
                            </div></fieldset>

                        <p class="submit inline-edit-save">
                            <a accesskey="c" href="#inline-edit" class="button-secondary cancel alignleft">Cancel</a>
                            <input type="hidden" id="_inline_edit" name="_inline_edit" value="b28de76e42">				<a accesskey="s" href="#inline-edit" class="button-primary save alignright">Update</a>
                            <span class="spinner"></span>
                            <input type="hidden" name="post_view" value="list">
                            <input type="hidden" name="screen" value="edit-post">
                            <span class="error" style="display:none"></span>
                            <br class="clear">
                        </p>
                    </td></tr>

                <tr id="bulk-edit" class="inline-edit-row inline-edit-row-post inline-edit-post bulk-edit-row bulk-edit-row-post bulk-edit-post" style="display: none"><td colspan="7" class="colspanchange">

                        <fieldset class="inline-edit-col-left"><div class="inline-edit-col">
                                <h4>Bulk Edit</h4>
                                <div id="bulk-title-div">
                                    <div id="bulk-titles"></div>
                                </div>




                            </div></fieldset><fieldset class="inline-edit-col-center inline-edit-categories"><div class="inline-edit-col">


                                <span class="title inline-edit-categories-label">Categories</span>
                                <input type="hidden" name="post_category[]" value="0">
                                <ul class="cat-checklist category-checklist">

                                    <li id="category-1" class="popular-category"><label class="selectit"><input value="1" type="checkbox" name="post_category[]" id="in-category-1"> Uncategorized</label></li>
                                </ul>


                            </div></fieldset>


                        <fieldset class="inline-edit-col-right"><label class="inline-edit-tags">
                                <span class="title">Tags</span>
                                <textarea cols="22" rows="1" name="tax_input[post_tag]" class="tax_input_post_tag"></textarea>
                            </label><div class="inline-edit-col">

                                <label class="inline-edit-author"><span class="title">Author</span><select name="post_author" class="authors">
                                        <option value="-1">— No Change —</option>
                                        <option value="1">admin</option>
                                    </select></label>


                                <div class="inline-edit-group">
                                    <label class="alignleft">
                                        <span class="title">Comments</span>
                                        <select name="comment_status">
                                            <option value="">— No Change —</option>
                                            <option value="open">Allow</option>
                                            <option value="closed">Do not allow</option>
                                        </select>
                                    </label>
                                    <label class="alignright">
                                        <span class="title">Pings</span>
                                        <select name="ping_status">
                                            <option value="">— No Change —</option>
                                            <option value="open">Allow</option>
                                            <option value="closed">Do not allow</option>
                                        </select>
                                    </label>
                                </div>


                                <div class="inline-edit-group">
                                    <label class="inline-edit-status alignleft">
                                        <span class="title">Status</span>
                                        <select name="_status">
                                            <option value="-1">— No Change —</option>
                                            <option value="publish">Published</option>

                                            <option value="private">Private</option>
                                            <option value="pending">Pending Review</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </label>



                                    <label class="alignright">
                                        <span class="title">Sticky</span>
                                        <select name="sticky">
                                            <option value="-1">— No Change —</option>
                                            <option value="sticky">Sticky</option>
                                            <option value="unsticky">Not Sticky</option>
                                        </select>
                                    </label>



                                </div>
                            </div></fieldset>

                        <p class="submit inline-edit-save">
                            <a accesskey="c" href="#inline-edit" class="button-secondary cancel alignleft">Cancel</a>
                            <input type="submit" name="bulk_edit" id="bulk_edit" class="button button-primary alignright" value="Update" accesskey="s">			<input type="hidden" name="post_view" value="list">
                            <input type="hidden" name="screen" value="edit-post">
                            <span class="error" style="display:none"></span>
                            <br class="clear">
                        </p>
                    </td></tr>
            </tbody></table></form>

    <div id="ajax-response"></div>
    <br class="clear">
</div>