import { ChurchEventType } from "./ChurchEventType";
export type ChurchEvent = {
    id: number;
    name: string;
    picture?: string;
    short_description?: string;
    description?: string;
    start_time: string;
    end_time: string;
    location?: string;
    type: ChurchEventType;
    createdAt: Date;
    updatedAt: Date;
}
