var ARISJS = function()
{
    this.requestsQueue = new Array();
    this.currentlyCalling = false;

    this.enqueueRequest = function(nextRequest)
    {
        this.requestsQueue.push(nextRequest);
        if(!this.currentlyCalling) 
        {
            this.currentlyCalling = true;
            this.dequeueRequest();
        }
    }

    this.isCurrentlyCalling = function()
    {
        this.currentlyCalling = true;
    }

    this.dequeueRequest = function()
    {
        if(this.requestsQueue.length) 
        {
            var req = this.requestsQueue.shift();
            window.location = req;

            /* DEBUG - uncomment to use in browser without error */
/*
            this.isCurrentlyCalling();
            if(req == "aris://inventory/get/" + 99999999)
                this.didUpdateItemQty(99999999,1);
            this.isNotCurrentlyCalling();
*/
        }
    }

    this.isNotCurrentlyCalling = function()
    {
        this.currentlyCalling = false;
        this.dequeueRequest();
    }

    this.closeMe = function()
    {
        this.enqueueRequest("aris://closeMe");
    }

    this.prepareMedia = function(mediaId)
    {
        this.enqueueRequest("aris://media/prepare/" + mediaId);
    }

    this.playMedia = function(mediaId)
    {
        this.enqueueRequest("aris://media/play/" + mediaId);
    }

    this.playMediaAndVibrate = function(mediaId)
    {
        this.enqueueRequest("aris://media/playAndVibrate/" + mediaId);
    }

    this.stopMedia = function(mediaId)
    {
        this.enqueueRequest("aris://media/stop/" + mediaId);
    }

    this.setMediaVolume = function(mediaId, volume)
    {
        this.enqueueRequest("aris://media/setVolume/" + mediaId + "/" + volume);
    }

    this.getItemCount = function(itemId)
    {
        this.enqueueRequest("aris://inventory/get/" + itemId);
    }

    this.setItemCount = function(itemId,qty)
    { 
        this.enqueueRequest("aris://inventory/set/" + itemId + "/" + qty);
    }

    this.giveItemCount = function(itemId,qty)
    {
        this.enqueueRequest("aris://inventory/give/" + itemId + "/" + qty);
    }

    this.takeItemCount = function(itemId,qty)
    {
        this.enqueueRequest("aris://inventory/take/" + itemId + "/" + qty);
    }

    this.getPlayerName = function()
    {
        this.enqueueRequest("aris://player/name");
    }

    this.setBumpString = function(bString)
    {
        this.enqueueRequest("aris://bump/"+bString);
    }

    //Not ARIS related... just kinda useful
    this.parseURLParams = function(url) 
    {
        var queryStart = url.indexOf("?") + 1;
        var queryEnd   = url.indexOf("#") + 1 || url.length + 1;
        var query      = url.slice(queryStart, queryEnd - 1);

        var params  = {};
        if (query === url || query === "") return params;
        var nvPairs = query.replace(/\+/g, " ").split("&");

        for (var i=0; i<nvPairs.length; i++) {
            var nv = nvPairs[i].split("=");
            var n  = decodeURIComponent(nv[0]);
            var v  = decodeURIComponent(nv[1]);
            if ( !(n in params) ) {
                params[n] = [];
            }
            params[n].push(nv.length === 2 ? v : null);
        }
        return params;
    }

    /*
     * ARIS CALLBACK FUNCTIONS
     */
    this.didUpdateItemQty = function(updatedItemId,qty)
    {
        alert("Item '"+updatedItemId+"' qty was updated to '"+qty+"'. Override ARIS.didUpdateItemQty(updatedItemId,qty) to handle this event however you want! (Or, just add 'ARIS.didUpdateItemQty = function(updatedItemId,qty){return;};' to your code to just get rid of this message)");
    }

    this.bumpReceived = function(bumpString)
    {
        alert("Just recieved a successful bump with this information: '"+bumpString+"'. Override ARIS.bumpReceived(bumpString) to handle this event however you want! (Or, just add 'ARIS.bumpReceived = function(bumpString){return;};' to your code to just get rid of this message)");
    }
}

var ARIS = new ARISJS();
