import type {User} from './User'
export type UserTable = {
data: Array<User>,
total: number,
current_page: number,
per_page: number,
last_page: number,
links?: {
    first: string,
    last: string,
    next: string,
    prev: string,
}
};
