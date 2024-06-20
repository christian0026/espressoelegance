import{a as apiFetch}from"./fetch.js";import{s as state}from"./store.js";import{s as state$1}from"./watchers.js";import{r as removeNotice,c as createErrorNotice}from"./mutations3.js";import{a as addQueryArgs}from"./add-query-args.js";const trackOffer=()=>{var e;return apiFetch({path:`surecart/v1/checkouts/${state.checkout_id}/offer_upsell/${null===(e=state.upsell)||void 0===e?void 0:e.id}`,method:"POST",keepalive:!0})},preview=async()=>{try{if(!state.checkout_id||"busy"===state.loading)return;state.loading="busy",removeNotice();const{checkout:e,...t}=await upsellRequest({preview:!0});state.checkout=e,state.line_item=t}catch(e){if(console.error(e),((null==e?void 0:e.additional_errors)||[]).find((e=>{var t,i,o;return null===(o=null===(i=null===(t=null==e?void 0:e.data)||void 0===t?void 0:t.options)||void 0===i?void 0:i.purchasable_statuses)||void 0===o?void 0:o.includes("out_of_stock")})))return createErrorNotice({code:"out_of_stock",message:wp.i18n.__("Apologies, this is currently out of stock.","surecart")});if(((null==e?void 0:e.additional_errors)||[]).find((e=>"line_item.upsell.expired"===(null==e?void 0:e.code))))return state.loading="idle",createErrorNotice({code:"expired",message:wp.i18n.__("This offer has expired.","surecart")}),decline();createErrorNotice(e)}finally{state.loading="idle"}},accept=async()=>{try{if(!state.checkout_id||"busy"===state.loading)return;state.loading="busy",removeNotice();const{checkout:e}=await upsellRequest({preview:!1});handleCompletion(e)}catch(e){state.loading="idle",createErrorNotice(e)}},decline=async()=>{var e,t,i,o,l,r;try{if(!state.checkout_id||"busy"===state.loading)return;state.loading="busy",removeNotice();const a=await apiFetch({path:addQueryArgs(`surecart/v1/checkouts/${state.checkout_id}/decline_upsell/${null===(e=state.upsell)||void 0===e?void 0:e.id}`,{expand:["checkout","checkout.current_upsell","fees"]}),method:"POST",data:{...null===(i=state$1[null===(t=state.product)||void 0===t?void 0:t.id])||void 0===i?void 0:i.line_item,price_id:null===(l=null===(o=state.upsell)||void 0===o?void 0:o.price)||void 0===l?void 0:l.id,upsell:null===(r=state.upsell)||void 0===r?void 0:r.id,checkout:state.checkout_id}});handleCompletion(a)}catch(e){state.loading="idle",createErrorNotice(e)}},upsellRequest=e=>{var t,i,o,l,r;return apiFetch({path:addQueryArgs("surecart/v1/line_items/upsell",{...e,expand:["checkout","checkout.current_upsell","fees","line_item","line_item.price"]}),method:"POST",data:{...null===(i=state$1[null===(t=state.product)||void 0===t?void 0:t.id])||void 0===i?void 0:i.line_item,price_id:null===(l=null===(o=state.upsell)||void 0===o?void 0:o.price)||void 0===l?void 0:l.id,upsell:null===(r=state.upsell)||void 0===r?void 0:r.id,checkout:state.checkout_id}})},handleCompletion=e=>{var t,i,o,l,r;if(!(null===(t=e.current_upsell)||void 0===t?void 0:t.permalink)||(null===(i=null==e?void 0:e.current_upsell)||void 0===i?void 0:i.permalink)===(null===(o=state.upsell)||void 0===o?void 0:o.permalink))return state.loading="complete";state.loading="redirecting",window.location.assign(addQueryArgs(null===(l=e.current_upsell)||void 0===l?void 0:l.permalink,{sc_checkout_id:null===(r=state.checkout)||void 0===r?void 0:r.id,sc_form_id:state.form_id}))};export{accept as a,decline as d,preview as p,trackOffer as t};