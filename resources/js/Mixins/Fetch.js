import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue" ;
const csrf_token = computed(() => usePage().props.value.csrf_token);

export async function fetchAsJSON (url , {
    method, headers, body
}) {
    return await fetch(url, {
            "method": !method ? "POST" : method,
            "headers": {
                'Accept': 'application/json',
                'Content-Type': 'application/json' , 
                ...headers,
            },
            body: JSON.stringify({
                _token: csrf_token.value , ...body
            }),
        }).then(async response => ({
            response : await response , json : await response.json()
        })) ;
}