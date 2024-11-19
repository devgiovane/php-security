window.onload = () => {
    const crypto = window.crypto;

    async function getSecretKey() {
        const encoder = new TextEncoder();
        const secretKeyInputEl = document.getElementById('secret');
        const keyData = encoder.encode(secretKeyInputEl.value);
        return await crypto.subtle.importKey(
            'raw', keyData, { name: 'AES-GCM' }, false, [ 'encrypt' ]
        );
    }

    async function encryptData(data) {
        const key = await getSecretKey();
        const iv = crypto.getRandomValues(new Uint8Array(12));
        const encoder = new TextEncoder();
        const encodedData = encoder.encode(JSON.stringify(data));
        const encryptedData = await crypto.subtle.encrypt(
            { name: 'AES-GCM', iv: iv },
            key,
            encodedData
        );
        const encryptedArray = new Uint8Array(encryptedData);
        return {
            i: btoa(String.fromCharCode(...new Uint8Array(iv))), // IV Code
            t:  btoa(String.fromCharCode(...encryptedArray.slice(-16))), // Tag generated
            d: btoa(String.fromCharCode(...encryptedArray.slice(0, encryptedArray.length - 16))), // Payload generated
        };
    }

    const payloadInputEl = document.getElementById('json');
    const obfuscateButtonEl = document.getElementById('obfuscate');
    obfuscateButtonEl.onclick = async () => {
        const result = await encryptData(payloadInputEl.value);
        const resultPreEl = document.getElementById('result');
        resultPreEl.innerHTML = JSON.stringify(result);
    }
}