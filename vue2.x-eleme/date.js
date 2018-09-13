export function formatDate(date){
    let time =new Date(date);
    let y=time.getFullYear();
    let m=time.getMonth()+1;
    if(m<10){
        m='0'+m;
    }
    let d=time.getDate();
    if(d<10)d='0'+d;
    let h = time.getHours();
    if(h<10)h='0'+h;

    let min=time.getMinutes();
    if(min<10)min='0'+min;
    return y+'-'+m+'-'+d+'   '+h+':'+min;
   
};
export function saveToLocal(id, key, value) {
	let seller = window.localStorage.__seller__;
	if (!seller) {
		seller = {};
		seller[id] = {};
	} else {
		seller = JSON.parse(seller);
		if (!seller[id]) {
			seller[id] = {};
		}
	}
	seller[id][key] = value;
	window.localStorage.__seller__ = JSON.stringify(seller);
};

export function loadFromLocal(id, key, def) {
	let seller = window.localStorage.__seller__;
	if (!seller) {
		return def;
	}
	seller = JSON.parse(seller)[id];
	if (!seller) {
		return def;
	}
	let ret = seller[key];
	return ret || def;
};


//module.exports = func;