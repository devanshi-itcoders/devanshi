(function(L){L.fn.qrcode=function(a){var B;function y(t){this.mode=B,this.data=t}function p(t,e){this.typeNumber=t,this.errorCorrectLevel=e,this.modules=null,this.moduleCount=0,this.dataCache=null,this.dataList=[]}function d(t,e){if(t.length==null)throw Error(t.length+"/"+e);for(var o=0;o<t.length&&t[o]==0;)o++;this.num=Array(t.length-o+e);for(var r=0;r<t.length-o;r++)this.num[r]=t[r+o]}function C(t,e){this.totalCount=t,this.dataCount=e}function c(){this.buffer=[],this.length=0}y.prototype={getLength:function(){return this.data.length},write:function(t){for(var e=0;e<this.data.length;e++)t.put(this.data.charCodeAt(e),8)}},p.prototype={addData:function(t){this.dataList.push(new y(t)),this.dataCache=null},isDark:function(t,e){if(0>t||this.moduleCount<=t||0>e||this.moduleCount<=e)throw Error(t+","+e);return this.modules[t][e]},getModuleCount:function(){return this.moduleCount},make:function(){if(1>this.typeNumber){for(var t=1,t=1;40>t;t++){for(var e=C.getRSBlocks(t,this.errorCorrectLevel),o=new c,r=0,n=0;n<e.length;n++)r+=e[n].dataCount;for(n=0;n<this.dataList.length;n++)e=this.dataList[n],o.put(e.mode,4),o.put(e.getLength(),g.getLengthInBits(e.mode,t)),e.write(o);if(o.getLengthInBits()<=8*r)break}this.typeNumber=t}this.makeImpl(!1,this.getBestMaskPattern())},makeImpl:function(t,e){this.moduleCount=4*this.typeNumber+17,this.modules=Array(this.moduleCount);for(var o=0;o<this.moduleCount;o++){this.modules[o]=Array(this.moduleCount);for(var r=0;r<this.moduleCount;r++)this.modules[o][r]=null}this.setupPositionProbePattern(0,0),this.setupPositionProbePattern(this.moduleCount-7,0),this.setupPositionProbePattern(0,this.moduleCount-7),this.setupPositionAdjustPattern(),this.setupTimingPattern(),this.setupTypeInfo(t,e),7<=this.typeNumber&&this.setupTypeNumber(t),this.dataCache==null&&(this.dataCache=p.createData(this.typeNumber,this.errorCorrectLevel,this.dataList)),this.mapData(this.dataCache,e)},setupPositionProbePattern:function(t,e){for(var o=-1;7>=o;o++)if(!(-1>=t+o||this.moduleCount<=t+o))for(var r=-1;7>=r;r++)-1>=e+r||this.moduleCount<=e+r||(this.modules[t+o][e+r]=0<=o&&6>=o&&(r==0||r==6)||0<=r&&6>=r&&(o==0||o==6)||2<=o&&4>=o&&2<=r&&4>=r)},getBestMaskPattern:function(){for(var t=0,e=0,o=0;8>o;o++){this.makeImpl(!0,o);var r=g.getLostPoint(this);(o==0||t>r)&&(t=r,e=o)}return e},createMovieClip:function(t,e,o){for(t=t.createEmptyMovieClip(e,o),this.make(),e=0;e<this.modules.length;e++)for(var o=1*e,r=0;r<this.modules[e].length;r++){var n=1*r;this.modules[e][r]&&(t.beginFill(0,100),t.moveTo(n,o),t.lineTo(n+1,o),t.lineTo(n+1,o+1),t.lineTo(n,o+1),t.endFill())}return t},setupTimingPattern:function(){for(var t=8;t<this.moduleCount-8;t++)this.modules[t][6]==null&&(this.modules[t][6]=t%2==0);for(t=8;t<this.moduleCount-8;t++)this.modules[6][t]==null&&(this.modules[6][t]=t%2==0)},setupPositionAdjustPattern:function(){for(var t=g.getPatternPosition(this.typeNumber),e=0;e<t.length;e++)for(var o=0;o<t.length;o++){var r=t[e],n=t[o];if(this.modules[r][n]==null)for(var i=-2;2>=i;i++)for(var u=-2;2>=u;u++)this.modules[r+i][n+u]=i==-2||i==2||u==-2||u==2||i==0&&u==0}},setupTypeNumber:function(t){for(var e=g.getBCHTypeNumber(this.typeNumber),o=0;18>o;o++){var r=!t&&(e>>o&1)==1;this.modules[Math.floor(o/3)][o%3+this.moduleCount-8-3]=r}for(o=0;18>o;o++)r=!t&&(e>>o&1)==1,this.modules[o%3+this.moduleCount-8-3][Math.floor(o/3)]=r},setupTypeInfo:function(t,e){for(var o=g.getBCHTypeInfo(this.errorCorrectLevel<<3|e),r=0;15>r;r++){var n=!t&&(o>>r&1)==1;6>r?this.modules[r][8]=n:8>r?this.modules[r+1][8]=n:this.modules[this.moduleCount-15+r][8]=n}for(r=0;15>r;r++)n=!t&&(o>>r&1)==1,8>r?this.modules[8][this.moduleCount-r-1]=n:9>r?this.modules[8][15-r-1+1]=n:this.modules[8][15-r-1]=n;this.modules[this.moduleCount-8][8]=!t},mapData:function(t,e){for(var o=-1,r=this.moduleCount-1,n=7,i=0,u=this.moduleCount-1;0<u;u-=2)for(u==6&&u--;;){for(var s=0;2>s;s++)if(this.modules[r][u-s]==null){var l=!1;i<t.length&&(l=(t[i]>>>n&1)==1),g.getMask(e,r,u-s)&&(l=!l),this.modules[r][u-s]=l,n--,n==-1&&(i++,n=7)}if(r+=o,0>r||this.moduleCount<=r){r-=o,o=-o;break}}}},p.PAD0=236,p.PAD1=17,p.createData=function(t,e,o){for(var e=C.getRSBlocks(t,e),r=new c,n=0;n<o.length;n++){var i=o[n];r.put(i.mode,4),r.put(i.getLength(),g.getLengthInBits(i.mode,t)),i.write(r)}for(n=t=0;n<e.length;n++)t+=e[n].dataCount;if(r.getLengthInBits()>8*t)throw Error("code length overflow. ("+r.getLengthInBits()+">"+8*t+")");for(r.getLengthInBits()+4<=8*t&&r.put(0,4);r.getLengthInBits()%8!=0;)r.putBit(!1);for(;!(r.getLengthInBits()>=8*t)&&(r.put(p.PAD0,8),!(r.getLengthInBits()>=8*t));)r.put(p.PAD1,8);return p.createBytes(r,e)},p.createBytes=function(t,e){for(var o=0,r=0,n=0,i=Array(e.length),u=Array(e.length),s=0;s<e.length;s++){var l=e[s].dataCount,v=e[s].totalCount-l,r=Math.max(r,l),n=Math.max(n,v);i[s]=Array(l);for(var h=0;h<i[s].length;h++)i[s][h]=255&t.buffer[h+o];for(o+=l,h=g.getErrorCorrectPolynomial(v),l=new d(i[s],h.getLength()-1).mod(h),u[s]=Array(h.getLength()-1),h=0;h<u[s].length;h++)v=h+l.getLength()-u[s].length,u[s][h]=0<=v?l.get(v):0}for(h=s=0;h<e.length;h++)s+=e[h].totalCount;for(o=Array(s),h=l=0;h<r;h++)for(s=0;s<e.length;s++)h<i[s].length&&(o[l++]=i[s][h]);for(h=0;h<n;h++)for(s=0;s<e.length;s++)h<u[s].length&&(o[l++]=u[s][h]);return o},B=4;for(var g={PATTERN_POSITION_TABLE:[[],[6,18],[6,22],[6,26],[6,30],[6,34],[6,22,38],[6,24,42],[6,26,46],[6,28,50],[6,30,54],[6,32,58],[6,34,62],[6,26,46,66],[6,26,48,70],[6,26,50,74],[6,30,54,78],[6,30,56,82],[6,30,58,86],[6,34,62,90],[6,28,50,72,94],[6,26,50,74,98],[6,30,54,78,102],[6,28,54,80,106],[6,32,58,84,110],[6,30,58,86,114],[6,34,62,90,118],[6,26,50,74,98,122],[6,30,54,78,102,126],[6,26,52,78,104,130],[6,30,56,82,108,134],[6,34,60,86,112,138],[6,30,58,86,114,142],[6,34,62,90,118,146],[6,30,54,78,102,126,150],[6,24,50,76,102,128,154],[6,28,54,80,106,132,158],[6,32,58,84,110,136,162],[6,26,54,82,110,138,166],[6,30,58,86,114,142,170]],G15:1335,G18:7973,G15_MASK:21522,getBCHTypeInfo:function(t){for(var e=t<<10;0<=g.getBCHDigit(e)-g.getBCHDigit(g.G15);)e^=g.G15<<g.getBCHDigit(e)-g.getBCHDigit(g.G15);return(t<<10|e)^g.G15_MASK},getBCHTypeNumber:function(t){for(var e=t<<12;0<=g.getBCHDigit(e)-g.getBCHDigit(g.G18);)e^=g.G18<<g.getBCHDigit(e)-g.getBCHDigit(g.G18);return t<<12|e},getBCHDigit:function(t){for(var e=0;t!=0;)e++,t>>>=1;return e},getPatternPosition:function(t){return g.PATTERN_POSITION_TABLE[t-1]},getMask:function(t,e,o){switch(t){case 0:return(e+o)%2==0;case 1:return e%2==0;case 2:return o%3==0;case 3:return(e+o)%3==0;case 4:return(Math.floor(e/2)+Math.floor(o/3))%2==0;case 5:return e*o%2+e*o%3==0;case 6:return(e*o%2+e*o%3)%2==0;case 7:return(e*o%3+(e+o)%2)%2==0;default:throw Error("bad maskPattern:"+t)}},getErrorCorrectPolynomial:function(t){for(var e=new d([1],0),o=0;o<t;o++)e=e.multiply(new d([1,f.gexp(o)],0));return e},getLengthInBits:function(t,e){if(1<=e&&10>e)switch(t){case 1:return 10;case 2:return 9;case B:return 8;case 8:return 8;default:throw Error("mode:"+t)}else if(27>e)switch(t){case 1:return 12;case 2:return 11;case B:return 16;case 8:return 10;default:throw Error("mode:"+t)}else if(41>e)switch(t){case 1:return 14;case 2:return 13;case B:return 16;case 8:return 12;default:throw Error("mode:"+t)}else throw Error("type:"+e)},getLostPoint:function(t){for(var e=t.getModuleCount(),o=0,r=0;r<e;r++)for(var n=0;n<e;n++){for(var i=0,u=t.isDark(r,n),s=-1;1>=s;s++)if(!(0>r+s||e<=r+s))for(var l=-1;1>=l;l++)0>n+l||e<=n+l||s==0&&l==0||u==t.isDark(r+s,n+l)&&i++;5<i&&(o+=3+i-5)}for(r=0;r<e-1;r++)for(n=0;n<e-1;n++)i=0,t.isDark(r,n)&&i++,t.isDark(r+1,n)&&i++,t.isDark(r,n+1)&&i++,t.isDark(r+1,n+1)&&i++,(i==0||i==4)&&(o+=3);for(r=0;r<e;r++)for(n=0;n<e-6;n++)t.isDark(r,n)&&!t.isDark(r,n+1)&&t.isDark(r,n+2)&&t.isDark(r,n+3)&&t.isDark(r,n+4)&&!t.isDark(r,n+5)&&t.isDark(r,n+6)&&(o+=40);for(n=0;n<e;n++)for(r=0;r<e-6;r++)t.isDark(r,n)&&!t.isDark(r+1,n)&&t.isDark(r+2,n)&&t.isDark(r+3,n)&&t.isDark(r+4,n)&&!t.isDark(r+5,n)&&t.isDark(r+6,n)&&(o+=40);for(n=i=0;n<e;n++)for(r=0;r<e;r++)t.isDark(r,n)&&i++;return t=Math.abs(100*i/e/e-50)/5,o+10*t}},f={glog:function(t){if(1>t)throw Error("glog("+t+")");return f.LOG_TABLE[t]},gexp:function(t){for(;0>t;)t+=255;for(;256<=t;)t-=255;return f.EXP_TABLE[t]},EXP_TABLE:Array(256),LOG_TABLE:Array(256)},m=0;8>m;m++)f.EXP_TABLE[m]=1<<m;for(m=8;256>m;m++)f.EXP_TABLE[m]=f.EXP_TABLE[m-4]^f.EXP_TABLE[m-5]^f.EXP_TABLE[m-6]^f.EXP_TABLE[m-8];for(m=0;255>m;m++)f.LOG_TABLE[f.EXP_TABLE[m]]=m;return d.prototype={get:function(t){return this.num[t]},getLength:function(){return this.num.length},multiply:function(t){for(var e=Array(this.getLength()+t.getLength()-1),o=0;o<this.getLength();o++)for(var r=0;r<t.getLength();r++)e[o+r]^=f.gexp(f.glog(this.get(o))+f.glog(t.get(r)));return new d(e,0)},mod:function(t){if(0>this.getLength()-t.getLength())return this;for(var e=f.glog(this.get(0))-f.glog(t.get(0)),o=Array(this.getLength()),r=0;r<this.getLength();r++)o[r]=this.get(r);for(r=0;r<t.getLength();r++)o[r]^=f.gexp(f.glog(t.get(r))+e);return new d(o,0).mod(t)}},C.RS_BLOCK_TABLE=[[1,26,19],[1,26,16],[1,26,13],[1,26,9],[1,44,34],[1,44,28],[1,44,22],[1,44,16],[1,70,55],[1,70,44],[2,35,17],[2,35,13],[1,100,80],[2,50,32],[2,50,24],[4,25,9],[1,134,108],[2,67,43],[2,33,15,2,34,16],[2,33,11,2,34,12],[2,86,68],[4,43,27],[4,43,19],[4,43,15],[2,98,78],[4,49,31],[2,32,14,4,33,15],[4,39,13,1,40,14],[2,121,97],[2,60,38,2,61,39],[4,40,18,2,41,19],[4,40,14,2,41,15],[2,146,116],[3,58,36,2,59,37],[4,36,16,4,37,17],[4,36,12,4,37,13],[2,86,68,2,87,69],[4,69,43,1,70,44],[6,43,19,2,44,20],[6,43,15,2,44,16],[4,101,81],[1,80,50,4,81,51],[4,50,22,4,51,23],[3,36,12,8,37,13],[2,116,92,2,117,93],[6,58,36,2,59,37],[4,46,20,6,47,21],[7,42,14,4,43,15],[4,133,107],[8,59,37,1,60,38],[8,44,20,4,45,21],[12,33,11,4,34,12],[3,145,115,1,146,116],[4,64,40,5,65,41],[11,36,16,5,37,17],[11,36,12,5,37,13],[5,109,87,1,110,88],[5,65,41,5,66,42],[5,54,24,7,55,25],[11,36,12],[5,122,98,1,123,99],[7,73,45,3,74,46],[15,43,19,2,44,20],[3,45,15,13,46,16],[1,135,107,5,136,108],[10,74,46,1,75,47],[1,50,22,15,51,23],[2,42,14,17,43,15],[5,150,120,1,151,121],[9,69,43,4,70,44],[17,50,22,1,51,23],[2,42,14,19,43,15],[3,141,113,4,142,114],[3,70,44,11,71,45],[17,47,21,4,48,22],[9,39,13,16,40,14],[3,135,107,5,136,108],[3,67,41,13,68,42],[15,54,24,5,55,25],[15,43,15,10,44,16],[4,144,116,4,145,117],[17,68,42],[17,50,22,6,51,23],[19,46,16,6,47,17],[2,139,111,7,140,112],[17,74,46],[7,54,24,16,55,25],[34,37,13],[4,151,121,5,152,122],[4,75,47,14,76,48],[11,54,24,14,55,25],[16,45,15,14,46,16],[6,147,117,4,148,118],[6,73,45,14,74,46],[11,54,24,16,55,25],[30,46,16,2,47,17],[8,132,106,4,133,107],[8,75,47,13,76,48],[7,54,24,22,55,25],[22,45,15,13,46,16],[10,142,114,2,143,115],[19,74,46,4,75,47],[28,50,22,6,51,23],[33,46,16,4,47,17],[8,152,122,4,153,123],[22,73,45,3,74,46],[8,53,23,26,54,24],[12,45,15,28,46,16],[3,147,117,10,148,118],[3,73,45,23,74,46],[4,54,24,31,55,25],[11,45,15,31,46,16],[7,146,116,7,147,117],[21,73,45,7,74,46],[1,53,23,37,54,24],[19,45,15,26,46,16],[5,145,115,10,146,116],[19,75,47,10,76,48],[15,54,24,25,55,25],[23,45,15,25,46,16],[13,145,115,3,146,116],[2,74,46,29,75,47],[42,54,24,1,55,25],[23,45,15,28,46,16],[17,145,115],[10,74,46,23,75,47],[10,54,24,35,55,25],[19,45,15,35,46,16],[17,145,115,1,146,116],[14,74,46,21,75,47],[29,54,24,19,55,25],[11,45,15,46,46,16],[13,145,115,6,146,116],[14,74,46,23,75,47],[44,54,24,7,55,25],[59,46,16,1,47,17],[12,151,121,7,152,122],[12,75,47,26,76,48],[39,54,24,14,55,25],[22,45,15,41,46,16],[6,151,121,14,152,122],[6,75,47,34,76,48],[46,54,24,10,55,25],[2,45,15,64,46,16],[17,152,122,4,153,123],[29,74,46,14,75,47],[49,54,24,10,55,25],[24,45,15,46,46,16],[4,152,122,18,153,123],[13,74,46,32,75,47],[48,54,24,14,55,25],[42,45,15,32,46,16],[20,147,117,4,148,118],[40,75,47,7,76,48],[43,54,24,22,55,25],[10,45,15,67,46,16],[19,148,118,6,149,119],[18,75,47,31,76,48],[34,54,24,34,55,25],[20,45,15,61,46,16]],C.getRSBlocks=function(t,e){var o=C.getRsBlockTable(t,e);if(o==null)throw Error("bad rs block @ typeNumber:"+t+"/errorCorrectLevel:"+e);for(var r=o.length/3,n=[],i=0;i<r;i++)for(var u=o[3*i+0],s=o[3*i+1],l=o[3*i+2],v=0;v<u;v++)n.push(new C(s,l));return n},C.getRsBlockTable=function(t,e){switch(e){case 1:return C.RS_BLOCK_TABLE[4*(t-1)+0];case 0:return C.RS_BLOCK_TABLE[4*(t-1)+1];case 3:return C.RS_BLOCK_TABLE[4*(t-1)+2];case 2:return C.RS_BLOCK_TABLE[4*(t-1)+3]}},c.prototype={get:function(t){return(this.buffer[Math.floor(t/8)]>>>7-t%8&1)==1},put:function(t,e){for(var o=0;o<e;o++)this.putBit((t>>>e-o-1&1)==1)},getLengthInBits:function(){return this.length},putBit:function(t){var e=Math.floor(this.length/8);this.buffer.length<=e&&this.buffer.push(0),t&&(this.buffer[e]|=128>>>this.length%8),this.length++}},typeof a=="string"&&(a={text:a}),a=L.extend({},{render:"canvas",width:256,height:256,typeNumber:-1,correctLevel:2,background:"#ffffff",foreground:"#000000"},a),this.each(function(){var t;if(a.render=="canvas"){t=new p(a.typeNumber,a.correctLevel),t.addData(a.text),t.make();var e=document.createElement("canvas");e.width=a.width,e.height=a.height;for(var o=e.getContext("2d"),r=a.width/t.getModuleCount(),n=a.height/t.getModuleCount(),i=0;i<t.getModuleCount();i++)for(var u=0;u<t.getModuleCount();u++){o.fillStyle=t.isDark(i,u)?a.foreground:a.background;var s=Math.ceil((u+1)*r)-Math.floor(u*r),l=Math.ceil((i+1)*r)-Math.floor(i*r);o.fillRect(Math.round(u*r),Math.round(i*n),s,l)}}else for(t=new p(a.typeNumber,a.correctLevel),t.addData(a.text),t.make(),e=L("<table></table>").css("width",a.width+"px").css("height",a.height+"px").css("border","0px").css("border-collapse","collapse").css("background-color",a.background),o=a.width/t.getModuleCount(),r=a.height/t.getModuleCount(),n=0;n<t.getModuleCount();n++)for(i=L("<tr></tr>").css("height",r+"px").appendTo(e),u=0;u<t.getModuleCount();u++)L("<td></td>").css("width",o+"px").css("background-color",t.isDark(n,u)?a.foreground:a.background).appendTo(i);t=e,jQuery(t).appendTo(this)})}})(jQuery);
