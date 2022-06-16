
import { fetchAsJSON } from "../Mixins/Fetch";

export async function sendVerificationCode (verifiable) {

    verifiable = typeof verifiable != "object" ? 
        { "verifiable" : verifiable }
        : verifiable  ;

    return await fetchAsJSON(route("auth.vc.send"), {
        body: verifiable
    }) ;
}