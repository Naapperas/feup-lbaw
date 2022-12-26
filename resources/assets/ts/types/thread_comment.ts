import { User } from "./user";

export interface ThreadComment {
    id: number;
    content: string;
    creation_date: Date;
    edit_date: Date;
    state: string;
    author_id: number;
    thread_id: number;

    author?: User;
}