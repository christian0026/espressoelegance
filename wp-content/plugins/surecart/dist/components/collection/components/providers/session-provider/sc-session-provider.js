import{h}from"@stencil/core";import{state as checkoutState}from"@store/checkout";import{clearCheckout}from"@store/checkout/mutations";import{state as selectedProcessor}from"@store/selected-processor";import{state as processorsState}from"@store/processors";import{__}from"@wordpress/i18n";import{addQueryArgs,getQueryArg,getQueryArgs,removeQueryArgs}from"@wordpress/url";import{updateFormState}from"@store/form/mutations";import{parseFormData}from"../../../functions/form-data";import{createCheckout,createOrUpdateCheckout,fetchCheckout,finalizeCheckout}from"../../../services/session";import{createErrorNotice,createInfoNotice,removeNotice}from"@store/notices/mutations";export class ScSessionProvider{constructor(){this.prices=[],this.persist=!0}handlePricesChange(){let e=this.addInitialPrices()||[];if(null==e?void 0:e.length)return this.loadUpdate({line_items:e})}async finalize(){return await this.handleFormSubmit()}async getFormData(){let e={};const t=this.el.querySelector("sc-form");if(t){const o=await t.getFormJson();e=parseFormData(o)}return e}async handleFormSubmit(){var e,t,o,r,a,i,c,s,n,d,u,l;if(removeNotice(),updateFormState("FINALIZE"),(null===(e=null==checkoutState?void 0:checkoutState.checkout)||void 0===e?void 0:e.payment_method_required)&&"stripe"===(null==selectedProcessor?void 0:selectedProcessor.id)&&processorsState.config.stripe.paymentElement){if(void 0===typeof(null===(t=null==processorsState?void 0:processorsState.instances)||void 0===t?void 0:t.stripeElements))return updateFormState("REJECT"),this.handleErrorResponse({message:"Stripe Elements not found.",code:"stripe_elements_not_found"}),new Error("Stripe Elements not found.");const{error:e}=await(null===(o=null==processorsState?void 0:processorsState.instances)||void 0===o?void 0:o.stripeElements.submit());if(e)return console.error({error:e}),updateFormState("REJECT"),void createErrorNotice(e)}let h=await this.getFormData();if((null===(r=null===window||void 0===window?void 0:window.scData)||void 0===r?void 0:r.recaptcha_site_key)&&(null===window||void 0===window?void 0:window.grecaptcha))try{h.grecaptcha=await window.grecaptcha.execute(window.scData.recaptcha_site_key,{action:"surecart_checkout_submit"})}catch(e){return console.error(e),updateFormState("REJECT"),this.handleErrorResponse(e),new Error(null==e?void 0:e.message)}try{await this.update(h)}catch(e){console.error(e),updateFormState("REJECT"),this.handleErrorResponse(e)}try{return checkoutState.checkout=await finalizeCheckout({id:null===(a=null==checkoutState?void 0:checkoutState.checkout)||void 0===a?void 0:a.id,query:{...(null==selectedProcessor?void 0:selectedProcessor.method)?{payment_method_type:null==selectedProcessor?void 0:selectedProcessor.method}:{},return_url:addQueryArgs(window.location.href,{...(null===(i=null==checkoutState?void 0:checkoutState.checkout)||void 0===i?void 0:i.id)?{checkout_id:null===(c=null==checkoutState?void 0:checkoutState.checkout)||void 0===c?void 0:c.id}:{},is_surecart_payment_redirect:!0})},data:h,processor:{id:selectedProcessor.id,manual:selectedProcessor.manual}}),["paid","processing"].includes(null===(s=checkoutState.checkout)||void 0===s?void 0:s.status)&&this.scPaid.emit(),(null===(l=null===(u=null===(d=null===(n=checkoutState.checkout)||void 0===n?void 0:n.payment_intent)||void 0===d?void 0:d.processor_data)||void 0===u?void 0:u.mollie)||void 0===l?void 0:l.checkout_url)?(updateFormState("PAYING"),setTimeout((()=>{var e,t,o,r;return window.location.assign(null===(r=null===(o=null===(t=null===(e=checkoutState.checkout)||void 0===e?void 0:e.payment_intent)||void 0===t?void 0:t.processor_data)||void 0===o?void 0:o.mollie)||void 0===r?void 0:r.checkout_url)}),50)):(setTimeout((()=>{updateFormState("PAYING")}),50),checkoutState.checkout)}catch(e){return console.error(e),this.handleErrorResponse(e),new Error(null==e?void 0:e.message)}}async handlePaid(){updateFormState("PAID")}async handleAbandonedCartUpdate(e){const t=e.detail;this.loadUpdate({abandoned_checkout_enabled:t})}async handleCouponApply(e){const t=e.detail;removeNotice(),this.loadUpdate({discount:{...t?{promotion_code:t}:{}}})}componentDidLoad(){this.findOrCreateOrder()}async findOrCreateOrder(){var e;const{redirect_status:t,checkout_id:o,line_items:r,coupon:a,is_surecart_payment_redirect:i}=getQueryArgs(window.location.href);if(window.history.replaceState({},document.title,removeQueryArgs(window.location.href,"redirect_status","coupon","line_items","confirm_checkout_id","checkout_id","no_cart")),i&&o)return updateFormState("FINALIZE"),updateFormState("PAYING"),this.handleCheckoutIdFromUrl(o,a);if(t)return this.handleRedirectStatus(t,o);if(o)return this.handleCheckoutIdFromUrl(o,a);if(r)return this.handleInitialLineItems(r,a);const c=null===(e=null==checkoutState?void 0:checkoutState.checkout)||void 0===e?void 0:e.id;return c&&this.persist?this.handleExistingCheckout(c,a):this.handleNewCheckout(a)}async handleRedirectStatus(e,t){var o,r;if(console.info("Handling payment redirect."),"failed"!==e)if(t)try{updateFormState("FINALIZE"),updateFormState("PAID"),checkoutState.checkout=await fetchCheckout({id:t,query:{refresh_status:!0}}),(null===(o=checkoutState.checkout)||void 0===o?void 0:o.status)&&["paid","processing"].includes(null===(r=checkoutState.checkout)||void 0===r?void 0:r.status)&&setTimeout((()=>{this.scPaid.emit()}),100)}catch(e){this.handleErrorResponse(e)}else createErrorNotice(__("Could not find checkout. Please contact us before attempting to purchase again.","surecart"));else createErrorNotice(__("Payment unsuccessful. Please try again.","surecart"))}async handleCheckoutIdFromUrl(e,t=""){var o,r;if(console.info("Handling existing checkout from url.",t,e),t)return this.loadUpdate({id:e,discount:{promotion_code:t},refresh_line_items:!0});try{if(updateFormState("FETCH"),checkoutState.checkout=await fetchCheckout({id:e,query:{refresh_status:!0}}),checkoutState.mode!==((null===(o=checkoutState.checkout)||void 0===o?void 0:o.live_mode)?"live":"test"))return console.info("Mode mismatch, creating new checkout."),clearCheckout(),checkoutState.checkout=null,void await this.handleNewCheckout(t);updateFormState("RESOLVE")}catch(e){this.handleErrorResponse(e)}switch(null===(r=checkoutState.checkout)||void 0===r?void 0:r.status){case"paid":case"processing":return setTimeout((()=>{updateFormState("FINALIZE"),updateFormState("PAID"),this.scPaid.emit()}),100);case"payment_failed":return clearCheckout(),createErrorNotice({message:__("Payment unsuccessful.","surecart")}),void updateFormState("REJECT");case"payment_intent_canceled":return void updateFormState("REJECT");case"canceled":return clearCheckout(),createErrorNotice({message:__("Payment canceled. Please try again.","surecart")}),void updateFormState("REJECT");case"finalized":return createErrorNotice({message:__("Payment unsuccessful. Please try again.","surecart")}),void updateFormState("REJECT")}}async handleInitialLineItems(e,t){console.info("Handling initial line items.");const o=this.el.querySelector("sc-order-shipping-address");return clearCheckout(),this.loadUpdate({line_items:e,refresh_line_items:!0,...t?{discount:{promotion_code:t}}:{},...(null==o?void 0:o.defaultCountry)?{shipping_address:{country:null==o?void 0:o.defaultCountry}}:{}})}async handleNewCheckout(e){var t;const o=this.getFormData();let r=checkoutState.initialLineItems||[];const a=this.el.querySelector("sc-order-shipping-address");try{updateFormState("FETCH"),checkoutState.checkout=await createCheckout({data:{...o,...e?{discount:{promotion_code:e}}:{},...(null==a?void 0:a.defaultCountry)?{shipping_address:{country:null==a?void 0:a.defaultCountry}}:{},line_items:r,...(null===(t=checkoutState.taxProtocol)||void 0===t?void 0:t.eu_vat_required)?{tax_identifier:{number_type:"eu_vat"}}:{}}}),updateFormState("RESOLVE")}catch(e){console.error(e),this.handleErrorResponse(e)}}async handleExistingCheckout(e,t){var o;if(!e)return this.handleNewCheckout(t);console.info("Handling existing checkout.");try{updateFormState("FETCH"),checkoutState.checkout=await createOrUpdateCheckout({id:e,data:{...t?{discount:{promotion_code:t}}:{},...(null===(o=checkoutState.taxProtocol)||void 0===o?void 0:o.eu_vat_required)?{tax_identifier:{number_type:"eu_vat"}}:{},refresh_line_items:!0}}),updateFormState("RESOLVE")}catch(e){console.error(e),this.handleErrorResponse(e)}}async handleErrorResponse(e){var t,o,r,a,i,c;if(["checkout.not_found"].includes(null==e?void 0:e.code))return clearCheckout(),this.handleNewCheckout(!1);const s=((null==e?void 0:e.additional_errors)||[]).some((e=>{var t,o;const r=(null===(o=null===(t=null==e?void 0:e.data)||void 0===t?void 0:t.options)||void 0===o?void 0:o.purchasable_statuses)||[];return["price_old_version","variant_old_version"].some((e=>r.includes(e)))}));if(s)return await this.loadUpdate({id:null===(t=null==checkoutState?void 0:checkoutState.checkout)||void 0===t?void 0:t.id,refresh_line_items:!0,status:"draft"}),createInfoNotice((null===(r=null===(o=null==e?void 0:e.additional_errors)||void 0===o?void 0:o[0])||void 0===r?void 0:r.message)||__("Some products in your order were outdated and have been updated. Please review your order summary before proceeding to payment.","surecart")),void updateFormState("REJECT");if("checkout.product.out_of_stock"===(null===(i=null===(a=null==e?void 0:e.additional_errors)||void 0===a?void 0:a[0])||void 0===i?void 0:i.code))return this.fetch(),void updateFormState("REJECT");if(["order.invalid_status_transition"].includes(null==e?void 0:e.code))return await this.loadUpdate({id:null===(c=null==checkoutState?void 0:checkoutState.checkout)||void 0===c?void 0:c.id,status:"draft"}),void this.handleFormSubmit();if("rest_cookie_invalid_nonce"!==(null==e?void 0:e.code)){if("readonly"===(null==e?void 0:e.code))return clearCheckout(),void window.location.assign(removeQueryArgs(window.location.href,"order"));createErrorNotice(e),updateFormState("REJECT")}else updateFormState("EXPIRE")}async initialize(e={}){let t=checkoutState.initialLineItems||[];return this.loadUpdate({...(null==t?void 0:t.length)?{line_items:t}:{},...e})}addInitialPrices(){var e;return(null===(e=null==this?void 0:this.prices)||void 0===e?void 0:e.length)?this.prices.some((e=>!(null==e?void 0:e.id)))?void 0:this.prices.map((e=>({price_id:e.id,quantity:e.quantity,variant:e.variant}))):[]}getSessionId(){var e,t;return getQueryArg(window.location.href,"checkout_id")||((null===(e=null==checkoutState?void 0:checkoutState.checkout)||void 0===e?void 0:e.id)?null===(t=null==checkoutState?void 0:checkoutState.checkout)||void 0===t?void 0:t.id:null)}async fetchCheckout(e,{query:t={},data:o={}}={}){try{updateFormState("FETCH");const r=await createOrUpdateCheckout({id:e,query:t,data:o});return updateFormState("RESOLVE"),r}catch(e){this.handleErrorResponse(e)}}async fetch(e={}){try{updateFormState("FETCH"),checkoutState.checkout=await fetchCheckout({id:this.getSessionId(),query:e}),updateFormState("RESOLVE")}catch(e){this.handleErrorResponse(e)}}async update(e={},t={}){try{checkoutState.checkout=await createOrUpdateCheckout({id:(null==e?void 0:e.id)?e.id:this.getSessionId(),data:e,query:t})}catch(e){if(["checkout.not_found"].includes(null==e?void 0:e.code))return clearCheckout(),this.initialize();throw console.error(e),e}}async loadUpdate(e={}){try{updateFormState("FETCH"),await this.update(e),updateFormState("RESOLVE")}catch(e){this.handleErrorResponse(e)}}render(){return h("sc-line-items-provider",{order:null==checkoutState?void 0:checkoutState.checkout,onScUpdateLineItems:e=>this.loadUpdate({line_items:e.detail})},h("slot",null))}static get is(){return"sc-session-provider"}static get encapsulation(){return"shadow"}static get properties(){return{prices:{type:"unknown",mutable:!1,complexType:{original:"Array<PriceChoice>",resolved:"PriceChoice[]",references:{Array:{location:"global"},PriceChoice:{location:"import",path:"../../../types"}}},required:!1,optional:!1,docs:{tags:[],text:"An array of prices to pre-fill in the form."},defaultValue:"[]"},persist:{type:"boolean",mutable:!1,complexType:{original:"boolean",resolved:"boolean",references:{}},required:!1,optional:!1,docs:{tags:[],text:"Should we persist the session."},attribute:"persist",reflect:!1,defaultValue:"true"}}}static get events(){return[{method:"scUpdateOrderState",name:"scUpdateOrderState",bubbles:!0,cancelable:!0,composed:!0,docs:{tags:[],text:"Update line items event"},complexType:{original:"Checkout",resolved:"Checkout",references:{Checkout:{location:"import",path:"../../../types"}}}},{method:"scUpdateDraftState",name:"scUpdateDraftState",bubbles:!0,cancelable:!0,composed:!0,docs:{tags:[],text:"Update line items event"},complexType:{original:"Checkout",resolved:"Checkout",references:{Checkout:{location:"import",path:"../../../types"}}}},{method:"scPaid",name:"scPaid",bubbles:!0,cancelable:!0,composed:!0,docs:{tags:[],text:""},complexType:{original:"void",resolved:"void",references:{}}},{method:"scSetState",name:"scSetState",bubbles:!0,cancelable:!0,composed:!0,docs:{tags:[],text:"Set the state"},complexType:{original:"FormStateSetter",resolved:'"EXPIRE" | "FETCH" | "FINALIZE" | "PAID" | "PAYING" | "REJECT" | "RESOLVE"',references:{FormStateSetter:{location:"import",path:"../../../types"}}}}]}static get methods(){return{finalize:{complexType:{signature:"() => Promise<Checkout | NodeJS.Timeout | Error>",parameters:[],references:{Promise:{location:"global"},Checkout:{location:"import",path:"../../../types"},NodeJS:{location:"global"},Error:{location:"global"}},return:"Promise<Checkout | Timeout | Error>"},docs:{text:"Finalize the order.",tags:[{name:"returns",text:void 0}]}}}}static get elementRef(){return"el"}static get watchers(){return[{propName:"prices",methodName:"handlePricesChange"}]}static get listeners(){return[{name:"scFormSubmit",method:"handleFormSubmit",target:void 0,capture:!1,passive:!1},{name:"scPaid",method:"handlePaid",target:void 0,capture:!1,passive:!1},{name:"scUpdateAbandonedCart",method:"handleAbandonedCartUpdate",target:void 0,capture:!1,passive:!1},{name:"scApplyCoupon",method:"handleCouponApply",target:void 0,capture:!1,passive:!1}]}}