<fieldset>
            <legend>Cover</legend>
            <div class="form-group">
                <div class="pael panel-dashed mb5">
                <div class="panel-body">
                    @if(!empty($cover_image->agent_listing_cover_image))
                    <div class="form-group" id="profileCoverImageOld">
                        <img id="profileCoverImage" src="{{ config('constants.AWS_CDN_URL') .'member_assets/photo/'.$cover_image->agent_listing_cover_image }}" alt="cover image" width="100%" height="150" class="of-cover" >
                    </div>
                    @else
                    <div class="form-group" id="profileCoverImageEmpty">
                        <img id="profileCoverImage" src="{{ asset('images/profile-header.jpg') }}" alt="cover image" width="100%" height="150" class="of-cover" >
                        </div>
                    @endif                
                    <input type="hidden" id="OldProfileCover" name="OldProfileCover" data-type="agent-listing" value="{{!empty($cover_image->agent_listing_cover_image)?$cover_image->agent_listing_cover_image:''}}" >
                    <button class="btn btn-secondary" data-toggle="modal" onclick="load_dc_modal('ProfileCover','profileCoverUpload','','')">
                    <svg viewBox="0 0 24 24" class="icon">
                        <use href="{{ asset('images/icons.svg#icon-upload') }}"></use>
                    </svg>
                    {{isset($cover_image->agent_listing_cover_image)?'Change Image':'Upload Image'}}
                    </button>
                </div>
                </div>
                <p class="help-block">
                Use a horizontal image for the best results.
                </p>
            </div>
        </fieldset>
        <fieldset>
            <legend>Sections</legend>
            <div class="table-responsive panel panel-primary">
                <table class="table table-striped table-vertical-center table-sortable table-with-icon table-hover" data-type="profileSections">
                <thead>
                    <tr>
                    <th>&nbsp;</th>
                    <th width="60" data-hover="tooltip" data-placement="left" title="Activate / Deactivate Links"><svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-toggle-right') }}"></use></svg></th>
                    <th>Section Name</th>
                    <th width="90"></th>
                    </tr>
                </thead>
                <tbody class="ui-sortable">
                    @if(!empty($sections) && !empty($sections))
                        <?php $LastTab = array(); ?>
                    @foreach($sections as $ds)
                        <?php 
                        if ($ds->section_slug == 'footer') {
                            $LastTab = array('id' => $ds->id, 'slug' => $ds->section_slug, 'title' => $ds->section_title, 'isActive' => $ds->is_active);
                        }else{ ?>
                        <tr class="ui-state-default {{ in_array(strtolower($ds->section_slug),$section_slug_disable_array) ? 'ui-state-disabled' : '' }}" data-section-id="{{$ds->id}}" id="{{$ds->id}}">
                        @if(in_array(strtolower($ds->section_slug),$section_slug_main_array))
                            <td>
                            @if(!in_array(strtolower($ds->section_slug),$section_slug_disable_array))
                                <svg viewBox="0 0 8 18" class="icon icon-move">
                                <use href="{{ asset('images/icons.svg#icon-move') }}"></use>
                                </svg>
                            @endif
                            </td>
                        <td data-hover="tooltip" data-placement="left" title="Enable / Disable">
                            <input type="checkbox" data-size="mini" data-type="switch" id="profileactive_{{$ds->id}}" onchange="ProfileSectionStatus('<?php echo $ds->id; ?>')" @if($ds->is_active ==='Y') checked @endif>
                            
                        @if(in_array(strtolower($ds->section_slug),$section_slug_array))
                            </td>
                            <th>
                                <a href="#" data-toggle="modal" onclick="modalAddEditSection('<?php echo $ds->id; ?>','<?php echo $ds->section_slug; ?>')">{{$ds->section_title}}</a>
                            </th>
                            <td>
                                <button type="button" class="btn btn-icon btn-default btn-rounded-minimal" data-hover="tooltip" data-placement="top" title="Edit Section" onclick="modalAddEditSection('<?php echo $ds->id; ?>','<?php echo $ds->section_slug; ?>')">
                                <svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-pencil') }}"></use></svg>
                                </button>                                     
                            @if(strtolower($ds->section_slug) == 'custom')
                                <button type="button" class="btn btn-icon btn-default btn-rounded-minimal" data-hover="tooltip" data-placement="top" title="Delete Section" data-name="deleteSection" onclick="deleteCustomSection('<?php echo $ds->id; ?>','<?php echo $ds->section_slug; ?>',1)">
                                <svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-delete') }}"></use></svg>
                                </button>
                            @endif
                            </td>
                        @endif
                        @if(strtolower($ds->section_slug) == 'branded_reports')
                            <th>
                                <a style="cursor: pointer;" onclick="editBrandedReportTab('<?php echo Encode($ds->id); ?>')" class="branded_reports_label">{{$ds->section_title}}</a>
                            </th>
                            <td>
                                <button type="button" class="btn btn-icon btn-default btn-rounded-minimal" data-hover="tooltip" data-placement="top" title="Edit Section" onclick="editBrandedReportTab('<?php echo Encode($ds->id); ?>')">
                                <svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-pencil') }}"></use></svg>
                                </button>                                                 
                            </td>
                        @endif
                        @if(strtolower($ds->section_slug) == 'current_listings')
                            <th>
                                <a href="#"  onclick="fetchCurrentListing()">{{$ds->section_title}}</a>
                            </th>
                            <td>
                                <button type="button" class="btn btn-icon btn-default btn-rounded-minimal" data-hover="tooltip" data-placement="top" title="Edit Section"  onclick="fetchCurrentListing()">
                                <svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-pencil') }}"></use></svg>
                                </button>                                                 
                            </td>
                        @endif
                        @if(strtolower($ds->section_slug) == "reviews")
                            <th>{{$ds->section_title}}</th><td></td>
                        @endif
                        @if(strtolower($ds->section_slug) == "social_media_posts")
                            <th>{{$ds->section_title}}</th><td></td>
                        @endif
                        @if(strtolower($ds->section_slug) == "market_section")
                            <th>
                            <a style="cursor: pointer;" onclick="fetchLadingPageList();">{{$ds->section_title}}</a>
                            </th>
                            <td>
                            <button type="button" class="btn btn-icon btn-default btn-rounded-minimal" data-hover="tooltip" data-placement="top" title="Edit Section" onclick="fetchLadingPageList();"  >
                                <svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-pencil') }}"></use></svg>
                            </button>                                                 
                            </td>
                        @endif
                        @if(strtolower($ds->section_slug) == "contact_form")
                        <?php $contactTitle = $ds->section_title;
                                $contactField = json_decode($ds['profile_content'][0]->extra_content,true); ?>
                            <th>
                                <a href="#" data-toggle="modal" data-target="#modalEditCFSection" data-backdrop="static" data-keyboard="false">{{$ds->section_title}}</a>
                            </th>
                            <td>
                                <button type="button" class="btn btn-icon btn-default btn-rounded-minimal" data-hover="tooltip" data-placement="top" title="Edit Section" data-toggle="modal" data-target="#modalEditCFSection">
                                <svg viewBox="0 0 24 24" class="icon"><use href="{{ asset('images/icons.svg#icon-pencil') }}"></use></svg>
                                </button>                                                 
                            </td>
                            @endif
                            @if(strtolower($ds->section_slug) == "footer")
                            <?php $saticFooterShow = ''; ?>
                            <th>{{$ds->section_title}}</th><td></td>
                            @endif
                        @endif
                    </tr>
                        <?php } ?>
                    @endforeach
                    <?php if(!empty($LastTab)){ ?>
                    <?php $saticFooterShow = ''; ?>
                        <tr class="ui-state-disabled">
                            <td></td>
                            <td data-hover="tooltip" data-placement="left" title="Enable / Disable">
                                <input type="checkbox" data-size="mini" data-type="switch" id="profileactive_{{$LastTab['id']}}" onchange="ProfileSectionStatus('<?php echo $LastTab['id']; ?>')" @if($LastTab['isActive'] ==='Y') checked @endif></td>
                            <th>{{$LastTab['title']}}</th>
                            <td></td>
                        </tr>
                    <?php } ?>
                    @endif
                    @if(!empty($saticFooterShow) && $saticFooterShow == 'show')
                    <tr class="ui-state-disabled">
                        <td>
                            <!--  <svg viewBox="0 0 8 18" class="icon icon-move">
                                <use href="{{ asset('images/icons.svg#icon-move') }}"></use>
                            </svg> -->
                            </td>
                        <td data-hover="tooltip" data-placement="left" title="Enable / Disable">
                            <input type="checkbox" data-size="mini" data-type="switch" id="profileactive_{{$ds->id}}" onchange="ProfileSectionStatus('')" checked></td>
                        <th>Footer</th>
                        <td></td>
                    </tr>
                    @endif
                </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-primary" onclick="modalAddEditSection('','custom')">Add Custom Section</button>
        </fieldset>