$( document ).ready(function() {
    var base_url = $('.base_url').val();
    $('.loader').hide();
     $( "#datepicker" ).datepicker();

    $('.load_more_matches').click(function(e){
    	$('.loader').show();
    	var type 	= $(this).attr('data-type');
    	var start 	= $('#start_page').val();
    	var end 	= $('#end_page').val();
    	if(type == 'next'){    		
    		var offset = parseInt(end);
    	}else{    		
    		var offset = parseInt(start)-5;
    	}
    	$('#offset').val(offset);
    	$('#matches_form_hidden').submit();

    })


    $('#add_team').click(function(e) {
        var action_modal = $('#action_modal').val();
        if(action_modal == "add_team"){
        }else if(action_modal == 'add_player'){
        }else if(action_modal == 'add_score'){
            var url = base_url+'get-players';
            var tid = $('#wining_team_id').val();
            var mid = $('#hidd_match_id').val();
            get_players(tid,mid, url);
        }

        $('.modal-title').html("Add Team");
         $('#myModal').modal('show');
         $( "#datepicker" ).datepicker();
    });

    $('.save_mmodal_info').click(function(e) {
        var action_modal = $('#action_modal').val();
        
        var no_error = "";
        var data = new FormData();
        var url = '';
        if(action_modal == "add_team"){
            var url = base_url+'add-team';

            
            var form_data = $('#modal_form').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            //File data
            var file_data = $('input[name="in_team_logo"]')[0].files;
            data.append("in_team_logo", file_data[0]);

        }else if(action_modal == 'add_player'){
            var url = base_url+'add-player';
            var form_data = $('#modal_form').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
            //File data
            var file_data = $('input[name="in_player_logo"]')[0].files;
            data.append("in_player_logo", file_data[0]);
        }
        else if(action_modal == 'add_match'){
            var url = base_url+'add-match';
            var form_data = $('#modal_form').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
        }
        else if(action_modal == 'match_status'){
            var url = base_url+'update-match';
            var form_data = $('#modal_form').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
        }
        else if(action_modal == 'add_score'){
            var url = base_url+'add-score';
            var form_data = $('#modal_form').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
        }

        if(no_error == ""){            
            $.ajax({
                method : 'POST',
                url : url,     
                processData: false,
                contentType: false,
                data: data,                           
                success: function(resp)
                {
                    resp = JSON.parse(resp);
                    if(resp.type){
                        swal({'type' : 'success', 'title' : 'Success', 'text' : resp.message}, function(){ 
                        $('#myModal').modal('hide');
                        location.reload();
                    });
                    }else{
                        swal({'type' : 'error', 'title' : 'Error', 'text' : resp.message},function(){ 
                        // $('#myModal').modal('hide');
                        // location.reload();
                    });
                    }
                }
            });
        }
    });

    $('#in_match_status').change(function(){
        var sel = $(this).val();
        if(sel == '1'){
            $('#winning_team_select').show();
        }else{
            $('#winning_team_select').hide();
        }
    });

    $('#from_team_id').change(function(){
        var tid = $.trim($(this).val());
        if(tid != ''){
            var url = base_url+'get-players';            
            var mid = $('#hidd_match_id').val();
            get_players(tid,mid, url);
        }
    });
    
    
});

function get_players(team, match, url) {
    $('.loader').show();
    $.ajax({
        type : 'POST',
        url : url,   
        data: 'team_id='+team+'&match_id='+match+'&action=get_players',                           
        success: function(resp)
        {
            $('.loader').hide();
            resp = JSON.parse(resp);
            $('.selected_player_id').html('').html(resp.message);
            $('.in_wicket_by_select').html('').html(resp.details);
        }
            
    });
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}