import { EventBlogs } from "./EventBlogs"
export type EventBlogsTable = {
    data: Array<EventBlogs>
    total: number,
    current_page: number,
    per_page: number,
    last_page: number,
    from: number,
    to: number,
    links?: {
        first: string,
        last: string,
        next: string,
        prev: string,
    }
}