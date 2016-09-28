$(document).ready(function(){

    $('.modalButton').click(function() {
        var moda = $('#modal').modal('show').find('#modalContent');
        moda.html("<h1>Cargando...</h1>");
        moda.load($(this).attr('value'));
    });

    $('#connections-requested').PeriodicalUpdater('/connection/requested', {minTimeout: 5000, maxTimeout:60000,	multiplier: 2,}, function(remoteData, success, xhr, handle) {	
    	$(this).html(remoteData);
    });
    
    $('#connections-pending').PeriodicalUpdater('/connection/pending', {minTimeout: 5000, maxTimeout:60000,	multiplier: 2,}, function(remoteData, success, xhr, handle) {	
    	$(this).html(remoteData);
    });
});