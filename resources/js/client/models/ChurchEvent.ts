import { ChurchEventType } from "./ChurchEventType";
export type ChurchEvent = {
    id: number;
    name: string;
    picture?: string;
    description: string;
    startDate: Date;
    endDate: Date;
    location?: string;
    type: ChurchEventType;
    createdAt: Date;
    updatedAt: Date;
}
