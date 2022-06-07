import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue" ;
const csrf_token = computed(() => usePage().props.value.csrf_token);

export async function fetchAsJSON (url , {
    method, headers, body
}) {
    const data  = {
            "method": !method ? "POST" : method,
            "headers": {
                'Accept': 'application/json',
                'Content-Type': 'application/json' , 
                ...headers,
            },
        }; 

    if (method !== "GET" && method !== "HEAD") {
        data.body = JSON.stringify({
            _token: csrf_token.value , ...body
        })
    }

    return await fetch(url, data).then(async response => ({
            response : await response , json : await response.json()
        })) ;
}