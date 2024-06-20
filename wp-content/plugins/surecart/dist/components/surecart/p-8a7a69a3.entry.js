import{r as t,h as e,F as i,a as s}from"./p-cc7ce8c7.js";import{a as o}from"./p-18e45a13.js";import{b as r,e as a}from"./p-5ec5df35.js";import{a as d,g as n,b as l,s as c}from"./p-24f06282.js";import{c as p}from"./p-8266bbed.js";import{u}from"./p-f9c1f513.js";import{f as h}from"./p-a27e9b70.js";import{a as v}from"./p-1c2e2695.js";import"./p-4d73f82a.js";import"./p-25433d0f.js";import"./p-f70181c4.js";import"./p-830ab1a3.js";import"./p-a3a138d6.js";import"./p-7ef0f71c.js";import"./p-50da3ba3.js";import"./p-c27fae79.js";const f=":host{--sc-drawer-header-spacing:var(--sc-spacing-large);--sc-drawer-body-spacing:var(--sc-spacing-large);--sc-drawer-footer-spacing:var(--sc-spacing-large)}.cart{font-size:16px}.cart__header{display:flex;align-items:center;justify-content:space-between;width:100%;font-size:1em}.cart__close{opacity:0.75;transition:opacity 0.25s ease;cursor:pointer}.cart__close:hover{opacity:1}::slotted(*){padding:var(--sc-drawer-header-spacing);background:var(--sc-panel-background-color);position:relative}::slotted(sc-line-items){flex:1 1 auto;overflow:auto;-webkit-overflow-scrolling:touch;min-height:200px}::slotted(:last-child){border-bottom:0 !important}sc-drawer::part(body){display:flex;flex-direction:column;box-sizing:border-box;padding:0;overflow:hidden}";const m=class{constructor(e){t(this,e);this.open=null;this.formId=undefined;this.header=undefined;this.checkoutLink=undefined;this.cartTemplate=undefined;this.mode="live";this.checkoutUrl=undefined;this.alwaysShow=undefined;this.floatingIconEnabled=true;this.uiState="idle"}handleOpenChange(){var t,e,i;d.set("cart",{...d.state.cart,...{open:this.open}});if(this.open===true){this.fetchOrder()}else{(i=(e=(t=document===null||document===void 0?void 0:document.querySelector("sc-cart-icon"))===null||t===void 0?void 0:t.shadowRoot)===null||e===void 0?void 0:e.querySelector(".cart"))===null||i===void 0?void 0:i.focus()}}order(){return n(this.formId,this.mode)}setCheckout(t){l(t,this.formId)}pageHasForm(){return!!document.querySelector("sc-checkout")}getItemsCount(){var t,e;const i=(e=(t=c.checkout)===null||t===void 0?void 0:t.line_items)===null||e===void 0?void 0:e.data;let s=0;(i||[]).forEach((t=>{s=s+(t===null||t===void 0?void 0:t.quantity)}));return s}handleSetState(t){this.uiState=t.detail}handleCloseCart(){this.open=false}async fetchOrder(){var t;try{u("FETCH");c.checkout=await o({method:"GET",path:v(`${r}${(t=c.checkout)===null||t===void 0?void 0:t.id}`,{expand:a})});u("RESOLVE")}catch(t){console.error(t);u("REJECT");p(t)}}componentWillLoad(){this.open=!!d.state.cart.open;d.onChange("cart",(t=>{this.open=t.open}))}state(){var t,e,i,s,o,r,a,d,n,l,p;return{uiState:this.uiState,checkoutLink:this.checkoutLink,loading:this.uiState==="loading",busy:this.uiState==="busy",navigating:this.uiState==="navigating",empty:!((i=(e=(t=c.checkout)===null||t===void 0?void 0:t.line_items)===null||e===void 0?void 0:e.pagination)===null||i===void 0?void 0:i.count),order:c.checkout,lineItems:((o=(s=c.checkout)===null||s===void 0?void 0:s.line_items)===null||o===void 0?void 0:o.data)||[],tax_status:(r=c.checkout)===null||r===void 0?void 0:r.tax_status,customerShippingAddress:typeof((a=c.checkout)===null||a===void 0?void 0:a.customer)!=="string"?(n=(d=c.checkout)===null||d===void 0?void 0:d.customer)===null||n===void 0?void 0:n.shipping_address:{},shippingAddress:(l=c.checkout)===null||l===void 0?void 0:l.shipping_address,taxStatus:(p=c.checkout)===null||p===void 0?void 0:p.tax_status,formId:this.formId}}render(){return e("sc-cart-session-provider",null,e("sc-drawer",{open:this.open,onScAfterShow:()=>this.open=true,onScAfterHide:()=>{this.open=false}},this.open===true&&e(i,null,e("div",{class:"cart__header-suffix",slot:"header"},e("slot",{name:"cart-header"}),e("sc-error",{style:{"--sc-alert-border-radius":"0"},slot:"header"})),e("slot",null)),h()&&e("sc-block-ui",{"z-index":9})))}get el(){return s(this)}static get watchers(){return{open:["handleOpenChange"]}}};m.style=f;export{m as sc_cart};
//# sourceMappingURL=p-8a7a69a3.entry.js.map