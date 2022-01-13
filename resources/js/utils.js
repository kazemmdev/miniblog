export function errorsHandler(error) {

    if (error.response.status === 419) {
        throw new AuthError("Unauthenticated");
    }

    return error.response.data?.errors ?? error.response.data?.message ?? '';
}

export class AuthError extends Error {
}
