export function errorsHandler(error) {

    if (error.response.status === 419) {
        throw new AuthError("Unauthenticated");
    }

    return error.response.data?.errors;
}

export class AuthError extends Error {
}
